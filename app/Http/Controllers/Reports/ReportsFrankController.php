<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class ReportsFrankController extends Controller
{
    public function test(){
        $show = 1;
        $pdf = PDF::loadView('reports.books', compact('show'));
        return $pdf->download('trash.pdf');
    }
}
