<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Product;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('backend.profile.index', compact('user'));
    }
}
