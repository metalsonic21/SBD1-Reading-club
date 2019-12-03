<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EarningPlaysController extends Controller
{
    public function index(){
        return view('theater_plays.earningplays');
    }
}