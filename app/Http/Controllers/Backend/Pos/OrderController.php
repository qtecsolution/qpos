<?php

namespace App\Http\Controllers\Backend\Pos;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PosCart;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer')->latest()->paginate(10);
        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
                'integer', // Ensure customer_id is an integer
            ],
            'order_discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'paid' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ], [
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'order_discount.numeric' => 'The order discount must be a number.',
            'paid.numeric' => 'The amount paid must be a number.',
        ]);

        $carts = PosCart::with('product')->where('user_id', auth()->id())->get();
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);
        $totalAmountOrder = 0;
        $orderDiscount = $request->order_discount;
        foreach ($carts as $cart) {
            $mainTotal = $cart->product->price * $cart->quantity;
            $totalAfterDiscount = $cart->product->discounted_price * $cart->quantity;
            $discount = $mainTotal - $totalAfterDiscount;
            $totalAmountOrder += $totalAfterDiscount;
            $order->products()->create([
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'sub_total' => $mainTotal,
                'discount' => $discount,
                'total' => $totalAfterDiscount,
                'product_id' => $cart->product->id,
            ]);
            $cart->product->quantity = $cart->product->quantity - $cart->quantity;
            $cart->product->save();
        }
        $total = $totalAmountOrder - $orderDiscount;
        $due = $total - $request->paid;
        $order->sub_total = $totalAmountOrder;
        $order->discount = $orderDiscount;
        $order->paid = $request->paid;
        $order->total = number_format((float)$total, 2, '.', '');
        $order->due = number_format((float)$due, 2, '.', '');
        $order->status = number_format((float)$due, 2, '.', '') <= 0;
        $order->save();
        $carts = PosCart::where('user_id', auth()->id())->delete();
        return response()->json(['message' => 'Order completed successfully', 'order' => $order], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function invoice($id)
    {
        $order = Order::with(['customer', 'products.product'])->findOrFail($id);
        return view('backend.orders.print-invoice', compact('order'));
    }
    public function collection(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'amount' => 'required|numeric',
            ]);


            $due = $order->due - $data['amount'];
            $paid = $order->paid + $data['amount'];
            $order->due = number_format((float)$due, 2, '.', '');
            $order->paid = number_format((float)$paid, 2, '.', '');
            $order->status = number_format((float)$due, 2, '.', '') <= 0;
            $order->save();
            $collection_amount = $data['amount'];
            return view('backend.orders.collection.invoice', compact('order', 'collection_amount'));
        }
        return view('backend.orders.collection.create', compact('order'));
    }
}
