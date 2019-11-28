<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClubReportsController extends Controller
{
    public function index(){
        return view ('clubs.reports');
    }
}
