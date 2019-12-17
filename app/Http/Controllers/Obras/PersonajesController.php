<?php

namespace App\Http\Controllers\Obras;
use DB;
use Response;
use App\Models\Remake\Personaje;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idobra, Request $request)
    {
        $personajes = DB::select(DB::raw("SELECT nom, descrip, id FROM sjl_personajes WHERE id_obra = '$idobra'"));
        if($request->ajax()){
            return Response::json(array('data'=>$personajes));
        }
        else{
            return view('obras.personajes');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
        }
        else{
            return view('obras.crearpersonaje');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personaje = new Personaje();
        $personaje->id_obra = $request->obra;
        $personaje->nom = $request->nom;
        $personaje->descrip = $request->descrip;
        $personaje->save();
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
    public function edit($idobra, $idper, Request $request)
    {
        $pers = DB::select(DB::raw("SELECT id, nom, descrip FROM sjl_personajes WHERE id = '$idper'"));
        $personaje = $pers[0];
        if($request->ajax()){
            return Response::json(array('data'=>$personaje));
        }
        else{
            return view('obras.editarpersonaje');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idobra, $idper)
    {
        Personaje::where(['id'=>$idper])->update(array(
            'nom'=>$request->nom,
            'descrip'=>$request->descrip,
        ));    
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idobra, $idper)
    {
        $personaje = Personaje::find($idper);
        $personaje->delete();
    }
}
