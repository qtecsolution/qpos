<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    
    public function saleReport(Request $request)
    {
        // Get user input or set default values
        $start_date_input = $request->input('start_date', Carbon::today()->subDays(29)->format('Y-m-d'));
        $end_date_input = $request->input('end_date', Carbon::today()->format('Y-m-d'));

        // Parse and set start date
        $start_date = Carbon::createFromFormat('Y-m-d', $start_date_input) ?: Carbon::today()->subDays(29)->startOfDay();
        $start_date = $start_date->startOfDay();

        // Parse and set end date
        $end_date = Carbon::createFromFormat('Y-m-d', $end_date_input) ?: Carbon::today()->endOfDay();
        $end_date = $end_date->endOfDay();
        // Retrieve orders within the date range
        $orders = Order::whereBetween('created_at', [$start_date, $end_date])->with('customer')->get();

        // Calculate totals
        $data = [
            'orders'=>$orders,
            'sub_total' => $orders->sum('sub_total'),
            'discount' => $orders->sum('discount'),
            'paid' => $orders->sum('paid'),
            'due' => $orders->sum('due'),
            'total' => $orders->sum('total'),
            'start_date' => $start_date->format('M d, Y'),
            'end_date' => $end_date->format('M d, Y'),
        ];

        return view('backend.reports.sale-report', $data);
    }
    public function saleSummery(Request $request)
    {
        // Get user input or set default values
        $start_date_input = $request->input('start_date', Carbon::today()->subDays(29)->format('Y-m-d'));
        $end_date_input = $request->input('end_date', Carbon::today()->format('Y-m-d'));

        // Parse and set start date
        $start_date = Carbon::createFromFormat('Y-m-d', $start_date_input) ?: Carbon::today()->subDays(29)->startOfDay();
        $start_date = $start_date->startOfDay();

        // Parse and set end date
        $end_date = Carbon::createFromFormat('Y-m-d', $end_date_input) ?: Carbon::today()->endOfDay();
        $end_date = $end_date->endOfDay();
        // Retrieve orders within the date range
        $orders = Order::whereBetween('created_at', [$start_date, $end_date])->get();

        // Calculate totals
        $data = [
            'sub_total' => $orders->sum('sub_total'),
            'discount' => $orders->sum('discount'),
            'paid' => $orders->sum('paid'),
            'due' => $orders->sum('due'),
            'total' => $orders->sum('total'),
            'start_date' => $start_date->format('M d, Y'),
            'end_date' => $end_date->format('M d, Y'),
        ];

        return view('backend.reports.sale-summery', $data);
    }

}
