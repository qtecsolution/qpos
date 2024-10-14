<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Trait\FileHandler;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public $fileHandler;

    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);
        $brand = Brand::create($request->except('brand_image'));
        if ($request->hasFile("brand_image")) {
            $brand->image = $this->fileHandler->fileUploadAndGetPath($request->file("brand_image"), "/public/media/brands");
            $brand->save();
        }

        return redirect()->route('backend.admin.brands.index')->with('success', 'Brand created successfully!');
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

        $brand = Brand::findOrFail($id);
        return view('backend.brands.edit', compact(  'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);
        $brand = Brand::findOrFail($id);
        $oldImage = $brand->image;
        $brand->update($request->except('brand_image'));
        if ($request->hasFile("brand_image")) {
            $brand->image = $this->fileHandler->fileUploadAndGetPath($request->file("brand_image"), "/public/media/brands");
            $brand->save();
            $this->fileHandler->secureUnlink($oldImage);
        }

        return redirect()->route('backend.admin.brands.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image != '') {
            $this->fileHandler->secureUnlink($brand->image);
        }
        $brand->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }
}
