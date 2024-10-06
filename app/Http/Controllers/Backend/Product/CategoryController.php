<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Trait\FileHandler;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::latest()->paginate(10);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);
        $category = Category::create($request->except('category_image'));
        if ($request->hasFile("category_image")) {
            $category->image = $this->fileHandler->fileUploadAndGetPath($request->file("category_image"), "/public/media/categories");
            $category->save();
        }

        return redirect()->route('backend.admin.categories.index')->with('success', 'Category created successfully!');
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

        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);
        $category = Category::findOrFail($id);
        $oldImage = $category->image;
        $category->update($request->except('category_image'));
        if ($request->hasFile("category_image")) {
            $category->image = $this->fileHandler->fileUploadAndGetPath($request->file("category_image"), "/public/media/categories");
            $category->save();
            $this->fileHandler->secureUnlink($oldImage);
        }

        return redirect()->route('backend.admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image != '') {
            $this->fileHandler->secureUnlink($category->image);
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
