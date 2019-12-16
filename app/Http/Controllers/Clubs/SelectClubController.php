<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class SelectClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));
        return view ('clubs.showlist')->with('clubs', $clubs)->with('current', 1);
        //return $clubs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function group(){
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));
        return view ('clubs.showlist')->with('clubs', $clubs)->with('current', 2);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gm(){
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));
        return view ('clubs.showlist')->with('clubs', $clubs)->with('current', 3);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function r(){
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));
        return view ('clubs.showlist')->with('clubs', $clubs)->with('current', 4);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pres(){
        $clubs = DB::select( DB::raw("SELECT c.id, c.nom, c.fec_crea, (
            SELECT nom from sjl_idiomas WHERE id = c.id_idiom 
        ) idioma, (
            SELECT p.nom from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = c.id_dir AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id
        ) as direccion FROM sjl_clubes_lectura c"));
        return view ('clubs.showlist')->with('clubs', $clubs)->with('current', 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
