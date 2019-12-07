<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CastPlaysController extends Controller
{
    public function index(){
        return view('theater_plays.castplays');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create() {
        return view('theater_plays.create');
    }
}
