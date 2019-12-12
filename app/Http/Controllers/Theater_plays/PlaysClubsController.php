<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PlaysClubsController extends Controller
{
    public function index(){
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));        
        return view('theater_plays.playsclubs',compact('clubs'));
    }
}