<?php

namespace App\Http\Controllers\Meetings;
use DB;
use Response;
use App\Models\Meeting\Inasistencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, $idgrupo, $idreunion, $idmod, $idlibro, Request $request)
    {
        if($request->ajax()){
            //$currentPR = DB::select(DB::raw("SELECT p.nom as text, p.id as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id"));
            //$members = DB::select(DB::raw("SELECT l.doc_iden as id, l.nom1 as nombre, l.ape1 as apellido, l."))
            $members = DB::select(DB::raw("SELECT l.doc_iden as id, l.nom1 as nombre, l.ape1 as apellido,
            l.ape2 as asist, (
                SELECT mg.id_fec_i FROM sjl_grupos_lectores mg WHERE id_club = '$idclub'
                AND id_grupo = '$idgrupo' AND mg.id_lec = l.doc_iden AND fec_f IS NULL
            )fig,
            (
                SELECT mg.id_fec_mem as fic FROM sjl_grupos_lectores mg WHERE id_club = '$idclub'
                AND id_grupo = '$idgrupo' AND mg.id_lec = l.doc_iden AND fec_f IS NULL
            ) FROM sjl_lectores l WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
            return Response::json(array('data'=>$members));
        }
        else{
            return view('meetings.createattendance');
        }
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
    public function store(Request $request, $idclub, $idgrupo, $idreunion, $idmod, $idlibro)
    {
        $members = $request->items;
        $gmemberships = $request->gdates;
        $cmemberships = $request->cdates;
        $atts = $request->att;

        for ($i=0 ; $i<$request->length; $i++){
            if ($atts[$i] == true){
                $falta = new Inasistencia();
                $falta->id_fec_i = $gmemberships[$i];
                $falta->id_fec_mem = $cmemberships[$i];
                $falta->id_club = $idclub;
                $falta->id_lec = $members[$i];
                $falta->id_grupo = $idgrupo;
                $falta->fec_reu_men = $idreunion;
                $falta->id_lib = $idlibro;
                $falta->save();
            }
        }
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
