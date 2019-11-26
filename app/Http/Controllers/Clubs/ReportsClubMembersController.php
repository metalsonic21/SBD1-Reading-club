<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsClubMembersController extends Controller
{
    public function index (){
        return view ('clubs.members');
    }
}
