<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function saleReport(Request $request){
        return view('backend.reports.sale-report');
    }
}
