<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    abort_if(!auth()->user()->can('supplier_view'), 403);
        if ($request->ajax()) {
            $suppliers = Supplier::latest()->get();
            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('name', fn($data) => $data->name)
                ->addColumn('phone', fn($data) => $data->phone)
                ->addColumn('address', fn($data) => $data->address)
                ->addColumn('created_at', fn($data) => $data->created_at->format('d M, Y')) // Using Carbon for formatting
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                    <button type="button" class="btn bg-gradient-primary btn-flat">Action</button>
                    <button type="button" class="btn bg-gradient-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="' . route('backend.admin.suppliers.edit', $data->id) . '" ' . ($data->id == 1 ? 'onclick="event.preventDefault();"' : '') . ' >
                    <i class="fas fa-edit"></i> Edit
                </a> <div class="dropdown-divider"></div>
<form action="' . route('backend.admin.suppliers.destroy', $data->id) . '"method="POST" style="display:inline;">
                   ' . csrf_field() . '
                    ' . method_field("DELETE") . '
<button type="submit" ' . ($data->id == 1 ? 'disabled' : '') . ' class="dropdown-item" onclick="return confirm(\'Are you sure ?\')"><i class="fas fa-trash"></i> Delete</button>
                  </form>
                    </div>
                  </div>';
                })
                ->rawColumns(['name', 'phone', 'address', 'created_at', 'action'])
                ->toJson();
        }
        if ($request->wantsJson()) {
            return response()->json(Supplier::latest()->get());
        }


        return view('backend.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    abort_if(!auth()->user()->can('supplier_create'), 403);
        return view('backend.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    abort_if(!auth()->user()->can('supplier_create'), 403);
        if ($request->wantsJson()) {
            $request->validate([
                'name' => 'required|string',
            ]);

            $supplier = Supplier::create([
                'name' => $request->name,
            ]);

            return response()->json($supplier);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:suppliers,phone',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($request->only(['name', 'phone', 'address']));

        session()->flash('success', 'Supplier created successfully.');
        return to_route('backend.admin.suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('supplier_update'), 403);
        $supplier = Supplier::findOrFail($id);
        return view('backend.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->can('supplier_update'), 403);
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:suppliers,phone,' . $supplier->id, // Corrected syntax
            'address' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->only(['name', 'phone', 'address']));

        session()->flash('success', 'Supplier updated successfully.');
        return to_route('backend.admin.suppliers.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(!auth()->user()->can('supplier_delete'), 403);
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        session()->flash('success', 'Supplier deleted successfully.');
        return to_route('backend.admin.suppliers.index');
    }
    public function getCustomers(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Supplier::latest()->get());
        }
    }
    //get orders by supplier id
    public function orders($id)
    {
        $supplier = Supplier::findOrFail($id);
        $orders = $supplier->orders()->paginate(100);
        return view('backend.orders.index', compact('orders'));
    }
}
