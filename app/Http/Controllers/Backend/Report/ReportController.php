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
        $start_date = Carbon::parse($request->input('start_date', Carbon::today()->subDays(29)));
        $end_date = Carbon::parse($request->input('end_date', Carbon::today()));
        $order = Order::whereBetween('created_at', [$start_date, $end_date])->get();
        $data['sub_total'] = $order->sum('sub_total');
        $data['discount'] = $order->sum('discount');
        $data['paid'] = $order->sum('paid');
        $data['due'] = $order->sum('due');
        $data['total'] = $order->sum('total');
        $data['start_date'] =  $start_date->format('M d,Y');
        $data['end_date'] =  $end_date->format('M d,Y');
        return view('backend.reports.sale-report', $data);
    }
}
