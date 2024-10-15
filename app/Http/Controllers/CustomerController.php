<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::latest()->get();
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('name', fn($data) => $data->name)
                ->addColumn('phone', fn($data) => $data->phone)
                ->addColumn('address', fn($data) => $data->address)
                ->addColumn('created_at', fn($data) => $data->created_at->format('d M, Y')) // Using Carbon for formatting
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">
                <a class="btn btn-sm bg-gradient-primary" href="' . route('backend.admin.customers.edit', $data->id) . '">
                    <i class="fas fa-edit"></i> Edit
                </a>
<form action="' . route('backend.admin.customers.destroy', $data->id) . '"method="POST" style="display:inline;">
                   ' . csrf_field() . '
                    ' . method_field("DELETE") . '
<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')">Delete</button>
                  </form>
            </div>';
                })
                ->rawColumns(['name', 'phone', 'address', 'created_at', 'action'])
                ->toJson();
        }


        return view('backend.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        if ($request->wantsJson()) {
            $request->validate([
                'name' => 'required|string',
            ]);

            $customer = Customer::create([
                'name' => $request->name,
            ]);

            return response()->json($customer);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create($request->only(['name', 'phone', 'address']));

        session()->flash('success', 'Customer created successfully.');
        return to_route('backend.admin.customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $customer->id, // Corrected syntax
            'address' => 'nullable|string|max:255',
        ]);

        $customer->update($request->only(['name', 'phone', 'address']));

        session()->flash('success', 'Customer updated successfully.');
        return to_route('backend.admin.customers.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        session()->flash('success', 'Customer deleted successfully.');
        return to_route('backend.admin.customers.index');
     
    }
    public function getCustomers(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Customer::latest()->get());
        }
    }

}
