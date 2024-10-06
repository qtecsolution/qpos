<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Trait\FileHandler;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::latest()->paginate(10);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        if ($request->hasFile("product_image")) {
            $product->image = $this->fileHandler->fileUploadAndGetPath($request->file("product_image"), "/public/media/products");
            $product->save();
        }

        return redirect()->route('backend.admin.products.index')->with('success', 'Product created successfully!');
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

        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.products.edit', compact('brands', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $validated = $request->validated();
        $product = Product::findOrFail($id);
        $oldImage = $product->image;
        $product->update($validated);
        if ($request->hasFile("product_image")) {
            $product->image = $this->fileHandler->fileUploadAndGetPath($request->file("product_image"), "/public/media/products");
            $product->save();
            $this->fileHandler->secureUnlink($oldImage);
        }

        return redirect()->route('backend.admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image != '') {
            $this->fileHandler->secureUnlink($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
