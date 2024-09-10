<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class CategoryController extends Controller
{
    //========================= blog category ===============================
    public function blogIndex()
    {
        return view('backend.blog-category.index');
    }

    public function fetchBlogCategoryData(Request $request)
    {
        if ($request->ajax()) {
            $categories = BlogCategory::latest()->paginate(10);
            return view('backend.blog-category.category-table-data', compact('categories'))->render();
        }
    }

    public function createBlogCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'nullable|string|max:255',
                'status' => 'nullable',
            ]);

            $newCategory = new BlogCategory();
            $newCategory->title = $request->title;
            $newCategory->slug = Str::slug($request->title) . '-' . uniqid();
            $newCategory->description = $request->description;
            $newCategory->status = $request->status ? 1 : 0;
            $newCategory->save();

            return redirect()->route('backend.admin.blog.categories')->with('success', 'Category created successfully');
        } else {
            return view('backend.blog-category.create-category');
        }
    }

    public function editBlogCategory(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'nullable|string|max:255',
                'status' => 'nullable',
            ]);

            $category->title = $request->title;
            if ($request->title != $category->title) {
                $category->slug = Str::slug($request->title) . '-' . uniqid();
            }
            $category->description = $request->description;
            $category->status = $request->status ? 1 : 0;
            $category->save();

            return redirect()->route('backend.admin.blog.categories')->with('success', 'Category updated successfully');
        } else {
            return view('backend.blog-category.edit-category', compact('category'));
        }
    }

    public function deleteBlogCategory($id)
    {
        try {
            BlogCategory::destroy($id);

            return back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete the selected item: It is associated with other data and cannot be removed');
        }
    }
}
