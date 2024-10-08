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
        $orders = Order::with('customer')->paginate(10);
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
            'customer_id' => 'required|exists:customers,id',
            'customer_id.required' => 'Please select a customer.', 
            'customer_id.exists' => 'The selected customer does not exist.',
        ]);
        $carts = PosCart::with('product')->where('user_id', auth()->id())->get();
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);
        $totalAmountOrder = 0;
        $orderDiscount = 0; //if user give discount $request->dicount;
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
        $order->sub_total = $totalAmountOrder;
        $order->discount = $orderDiscount;
        $order->total = $totalAmountOrder - $orderDiscount;
        $order->save();
        $carts = PosCart::where('user_id', auth()->id())->delete();
        return response()->json(['message' => 'Order completed successfully'], 200);
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
    public function invoice($id){
        $order = Order::with(['customer', 'products.product'])->findOrFail($id);
        return view('backend.orders.print-invoice', compact('order'));
    }
}
