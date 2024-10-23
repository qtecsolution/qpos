<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $purchases = Purchase::with('supplier')->latest()->get();
            return DataTables::of($purchases)
                ->addIndexColumn()
                ->addColumn('supplier', fn($data) => $data->supplier->name)
                ->addColumn('created_at', fn($data) => $data->created_at->format('d M, Y')) // Using Carbon for formatting
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                    <button type="button" class="btn bg-gradient-primary btn-flat">Action</button>
                    <button type="button" class="btn bg-gradient-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="' . route('backend.admin.customers.edit', $data->id) . '" ' . ($data->id == 1 ? 'onclick="event.preventDefault();"' : '') . ' >
                    <i class="fas fa-edit"></i> Edit
                </a> <div class="dropdown-divider"></div>
<form action="' . route('backend.admin.customers.destroy', $data->id) . '"method="POST" style="display:inline;">
                   ' . csrf_field() . '
                    ' . method_field("DELETE") . '
<button type="submit" ' . ($data->id == 1 ? 'disabled' : '') . ' class="dropdown-item" onclick="return confirm(\'Are you sure ?\')"><i class="fas fa-trash"></i> Delete</button>
                  </form>
<div class="dropdown-divider"></div>
  <a class="dropdown-item" href="' . route('backend.admin.purchase.products', $data->id) . '">
                <i class="fas fa-view"></i> View
            </a>
                    </div>
                  </div>';
                })
                ->rawColumns(['supplier','created_at', 'action'])
                ->toJson();
        }


        return view('backend.purchase.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->wantsJson()) {
            // Step 1: Validate the request data
            $validatedData = $request->validate([
                'products' => 'required|array',
                'date' => 'nullable|date',
                'supplierId' => 'required|exists:suppliers,id',
                'totals' => 'required|array',
                'totals.subTotal' => 'required|numeric',
                'totals.tax' => 'nullable|numeric',
                'totals.discount' => 'nullable|numeric',
                'totals.shipping' => 'nullable|numeric',
                'totals.grandTotal' => 'required|numeric',
            ]);

            // Step 2: Create a new purchase record
            $purchase = Purchase::create([
                'supplier_id' => $validatedData['supplierId'],
                'user_id' => auth()->id(),
                'sub_total' => $validatedData['totals']['subTotal'],
                'tax' => $validatedData['totals']['tax'],
                'discount_value' => $validatedData['totals']['discount'],
                'shipping' => $validatedData['totals']['shipping'],
                'grand_total' => $validatedData['totals']['grandTotal'],
                'date' => $validatedData['date'] ?? Carbon::now()->toDateString(),
                'status' => 1,
            ]);

            // Step 3: Create purchase items
            foreach ($validatedData['products'] as $product) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product['id'], 
                    'purchase_price' => $product['purchase_price'],
                    'price' => $product['price'],
                    'quantity' => $product['qty'],
                ]);
            }

            // Step 4: Return a response
            return response()->json([
                'message' => 'Purchase created successfully.',
                'purchase' => $purchase,
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
    // purchaseProducts list by Purchase id
    public function purchaseProducts(Request $request,$id)
    {
        $purchase = Purchase::with('items.product')->findOrFail($id);
        return view('backend.purchase.products',compact('id','purchase'));
    }
    
}
