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
                <a class="btn btn-sm bg-gradient-danger" href="' . route('backend.admin.customers.delete', $data->id) . '" onclick="return confirm(\'Are you sure ?\')">
                    <i class="fas fa-trash-alt"></i> Delete
                </a>
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
        //
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
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function getCustomers(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Customer::latest()->get());
        }
    }


}
