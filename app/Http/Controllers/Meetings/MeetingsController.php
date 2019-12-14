<?php

namespace App\Http\Controllers\Meetings;
use App\Models\Reunion;
use App\Models\Inasistencia;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, $idgrupo, Request $request)
    {
        if($request->ajax()){
            $meetings = DB::select(DB::raw("SELECT (
                SELECT titulo_esp FROM sjl_libros WHERE isbn = r.id_lib
            ) libro, r.fec as fecha, (
                SELECT nom1 || ' ' || ape1 FROM sjl_lectores WHERE doc_iden = r.id_lec 
            ) moderador , r.n_ses as sesion, r.valor as valoracion FROM sjl_reuniones_mensuales r"));
            return Response::json(array('data'=>$meetings));
        }
        else{
            return view('meetings.browsemeetings');
        }
    }

    public function calendar(){
        return view ('meetings.meetings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idclub, $idgrupo, Request $request)
    {
        if($request->ajax()){
            $members = DB::select(DB::raw("SELECT nom1 || ' ' || ape1 as text, doc_iden as value FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
            $libros = DB::select(DB::raw("SELECT isbn as id, titulo_esp as titulo_en_español, titulo_ori as titulo_original, fec_pub as fecha_de_publicacion, autor FROM sjl_libros"));
            return Response::json(array('data'=>$members,'libros'=>$libros));
        }
        else{
            return view('meetings.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idclub, $idgrupo)
    {
        $reunion = new Reunion();
        /* If there are meetings select the last one generated to generate one the month after that one*/
        $nextr = DB::select(DB::raw("SELECT fec FROM sjl_reuniones_mensuales WHERE fec IN (SELECT max(fec) FROM sjl_reuniones_mensuales WHERE id_club = '$idclub' AND id_grupo = '$idgrupo')"));
            if ($nextr){

            }
        else $nextr = DB::select(DB::raw("SELECT CURRENT_DATE as fec"));
        $basedate = $nextr[0]->fec;

        /* Next meeting date set */
        $effectiveDate = date('Y-m-d', strtotime("+1 months", strtotime($basedate)));

        $reunion->fec = $effectiveDate;
        $reunion->id_lib = $request->libro;
        $reunion->id_grupo = $idgrupo;

        /* Select actual membership for grupos_lectores */
        $am = DB::select(DB::raw("SELECT id_fec_i as fi FROM sjl_grupos_lectores WHERE id_lec = '$request->moderador' AND id_club = '$idclub' AND id_grupo = '$idgrupo' AND fec_f IS NULL"));
        $actualg = $am[0]->fi;

        /* Select actual membership for membership */
        $amc = DB::select(DB::raw("SELECT fec_i as fi FROM sjl_membresias WHERE id_lec = '$request->moderador' AND id_club = '$idclub' AND fec_f IS NULL"));
        $actualc = $am[0]->fi;

        $reunion->id_fec_i = $actualg;
        $reunion->id_fec_mem = $actualc;
        $reunion->id_club = $idclub;
        $reunion->id_lec = $request->moderador;
        $reunion->n_ses = $request->sesion;
        $reunion->conclu = $request->conclusion;
        $reunion->valor = $request->valoracion;
        $reunion->save();
        return $reunion;
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
