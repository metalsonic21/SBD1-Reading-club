<?php

namespace App\Http\Controllers\Groups;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelectGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub)
    {
        $groups = DB::select(DB::raw("SELECT nom, id_club, id, tipo, dia_sem, (select to_char(hora_i::time, 'HH12:MI AM')) || ' - ' || (select to_char(hora_f::time, 'HH12:MI AM')) as horario FROM sjl_grupos_lectura WHERE id_club = '$idclub'"));
        return view ('groups.showlist')->with('groups',$groups)->with('club',$idclub);
        //return view ('groups.showlist');
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
