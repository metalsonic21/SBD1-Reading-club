<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CastPlaysController extends Controller
{
    public function index(){
        return view('theater_plays.castplays');
    }
    public function create() {
        return view('theater_plays.create');
    }
    public function add() {
        return view('theater_plays.character_add');
    }
 }
