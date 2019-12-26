<?php

namespace App\Http\Controllers\Obras;
use DB;
use Response;
use App\Models\Obra\Local;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, Request $request)
    {   
        $locales = DB::select(DB::raw("SELECT l.nom, l.tipo, l.cap, l.id_club, l.id, (
            SELECT nom from sjl_calles WHERE id = l.id_dir
        )direccion FROM sjl_locales_eventos l WHERE id_club = '$idclub'"));
        if($request->ajax()){
            return Response::json(array('data'=>$locales));
        }
        else{
            return view('obras.locales');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obras.createlocal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $local = new Local();
        $local->nom = $request->nom;
        $local->tipo = $request->tipo;
        $local->cap = $request->cap;
        
        $dir = DB::select(DB::raw("SELECT id_dir as id from sjl_clubes_lectura WHERE id = '$request->club'"));
        $current = $dir[0]->id;
        
        $local->id_dir = $current;
        $local->id_club = $request->club;

        $local->save();

        return 1;
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
    public function edit($idclub, $idlocal, Request $request)
    {
        $local = DB::select(DB::raw("SELECT l.nom, l.tipo, l.cap, l.id, (
            SELECT nom from sjl_calles WHERE id = l.id_dir
        )direccion FROM sjl_locales_eventos l WHERE id_club = '$idclub' AND id = '$idlocal'"));
        $l = $local[0];
        if($request->ajax()){
            return Response::json(array('data'=>$l));
        }
        else{
            return view('obras.editlocal');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idclub, $idlocal)
    {
        $local = Local::find($idlocal);
        $local->nom = $request->nom;
        $local->tipo = $request->tipo;
        $local->cap = $request->cap;
        $local->id_club = $request->club;

        $local->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idclub, $idlocal)
    {
        $local = Local::find($idlocal);
        $local->delete();
    }
}
