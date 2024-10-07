<?php

namespace App\Http\Controllers\Backend\Pos;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response(
                $request->user()->cart()->get()
            );
        }
        return view('backend.cart.index');
    }
    public function getProducts(Request $request){
    $products = Product::query();
    $products->when($request->search, function ($query, $search) {
        $query->where('name', 'LIKE', "%{$search}%");
    });

    $products = $products->latest()->paginate(12);

    if (request()->wantsJson()) {
        return ProductResource::collection($products);
    }
     }
}
