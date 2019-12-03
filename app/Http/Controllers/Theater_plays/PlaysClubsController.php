<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaysClubsController extends Controller
{
    public function index(){
        return view('theater_plays.playsclubs');
    }
}