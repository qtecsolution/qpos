<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('unit_view'), 403);
        if ($request->ajax()) {
            $units = Unit::latest()->get();
            return DataTables::of($units)
                ->addIndexColumn()
                ->addColumn('title', fn($data) => $data->title)
                ->addColumn('short_name', fn($data) => $data->short_name)
               ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                    <button type="button" class="btn bg-gradient-primary btn-flat">Action</button>
                    <button type="button" class="btn bg-gradient-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="' . route('backend.admin.units.edit', $data->id) . '" ' .' >
                    <i class="fas fa-edit"></i> Edit
                </a> <div class="dropdown-divider"></div>
<form action="' . route('backend.admin.units.destroy', $data->id) . '"method="POST" style="display:inline;">
                   ' . csrf_field() . '
                    ' . method_field("DELETE") . '
<button type="submit" class="dropdown-item" onclick="return confirm(\'Are you sure ?\')"><i class="fas fa-trash"></i> Delete</button>
                  </form>
                  </div>';
                })
                ->rawColumns(['title', 'short_name','action'])
                ->toJson();
        }
        return view('backend.units.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('unit_create'), 403);
        return view('backend.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('unit_create'), 403);
        $unit = Unit::create($request->only(['title','short_name']));

        return redirect()->route('backend.admin.units.index')->with('success', 'Unit created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('unit_update'), 403);

        $unit = Unit::findOrFail($id);
        return view('backend.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->can('unit_update'), 403);
        $unitToUpdate = Unit::findOrFail($id);
        $unitToUpdate->update($request->only(['title', 'short_name']));
        return redirect()->route('backend.admin.units.index')->with('success', 'Unit updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(!auth()->user()->can('unit_delete'), 403);
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->back()->with('success', 'Unit Deleted Successfully');
    }
}
