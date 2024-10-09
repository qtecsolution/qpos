<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        // Calculate totals
        $data = [
            'sub_total' => $orders->sum('sub_total'),
            'discount' => $orders->sum('discount'),
            'total' => $orders->sum('total'),
            'paid' => $orders->sum('paid'),
            'due' => $orders->sum('due'),
            'total_customer' => Customer::count(),
            'total_order' => $orders->count(),
            'total_product' => Product::count(),
            'total_sale_item' => OrderProduct::sum('quantity'),
        ];
        return view('backend.index', $data);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('backend.profile.index', compact('user'));
    }
}
