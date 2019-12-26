<?php

namespace App\Http\Controllers\Obras;
use DB;
use Response;
use App\Models\Obra\Elenco;
use App\Models\Obra\Elenco_Principal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElencoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function castable($idclub, $fec, $idobra, $idlocal, Request $request)
    {
        $actores = DB::select(DB::raw("SELECT count(*) FROM sjl_lectores WHERE (id_club = '$idclub' OR id_club = (
            SELECT a.id_club1 FROM sjl_clubes_clubes a WHERE a.id_club2 = '$idclub'
        ) OR id_club = (
            SELECT a.id_club2 FROM sjl_clubes_clubes a WHERE a.id_club1 = '$idclub'
        )) AND (SELECT COUNT (*) FROM sjl_elenco_lectores e WHERE e.id_club = '$idclub' AND e.id_lec = doc_iden AND e.id_obra = '$idobra' AND e.id_hist_pre = '$fec' AND e.id_local = '$idlocal') = 0"));
        return $actores[0]->count;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, $fec, $idobra, $idlocal, Request $request)
    {
        if ($request->ajax()){
            $elenco = DB::select(DB::raw("SELECT e.id_hist_pre as presentacion, e.id_pers, e.id_lec, e.id_obra as obra, e.id_club as club, e.id_local as local, (
                SELECT nom1 || ' ' || ape1 as actor from sjl_lectores WHERE doc_iden = e.id_lec
            ), (
                SELECT nom as personaje from sjl_personajes WHERE id = e.id_pers AND id_obra = e.id_obra
            ), (
                CASE WHEN e.mej_act = 'true' THEN 'Si' ELSE 'No' END) as mejor
            , e.id_fec_mem as membresia, (CASE WHEN (
                SELECT principal FROM sjl_elenco WHERE id_fec_mem = e.id_fec_mem AND id_lec = e.id_lec AND id_club = e.id_club AND id_pers = e.id_pers AND id_obra = e.id_obra
            ) = 'true' THEN 'Si' ELSE 'No' END) as principal FROM sjl_elenco_lectores e WHERE e.id_club = '$idclub' AND e.id_hist_pre = '$fec' AND e.id_obra = '$idobra' AND e.id_local = '$idlocal'"));
                return Response::json(array('elenco'=>$elenco));
            }
            else{
                return view ('obras.elenco');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idclub, $fec, $idobra, $idlocal, Request $request)
    {
        if ($this->castable($idclub, $fec, $idobra, $idlocal, $request)!=0){
        if ($request->ajax()){
            /* Select people from club and associated that don't have roles in the same presentation */
            $actores = DB::select(DB::raw("SELECT nom1 || ' ' || ape1 as text, doc_iden as value FROM sjl_lectores WHERE (id_club = '$idclub' OR id_club = (
                SELECT a.id_club1 FROM sjl_clubes_clubes a WHERE a.id_club2 = '$idclub'
            ) OR id_club = (
                SELECT a.id_club2 FROM sjl_clubes_clubes a WHERE a.id_club1 = '$idclub'
            )) AND (SELECT COUNT (*) FROM sjl_elenco_lectores e WHERE e.id_club = '$idclub' AND e.id_lec = doc_iden AND e.id_obra = '$idobra' AND e.id_hist_pre = '$fec' AND e.id_local = '$idlocal') = 0"));

            /* Select characters that don't have any actor related */

            $personajes = DB::select(DB::raw("SELECT id as value, nom as text FROM sjl_personajes WHERE (
                SELECT COUNT (*) FROM sjl_elenco_lectores e WHERE e.id_club = '$idclub' AND e.id_obra = '$idobra' AND e.id_hist_pre = '$fec' AND e.id_local = '$idlocal' AND e.id_pers = id
            )=0 AND id_obra = '$idobra'"));


            return Response::json(array('actores'=>$actores, 'personajes'=>$personajes));
        }
        else {
            return view ('obras.createrole');
        }
    }
    
    else{
        return view('error.402');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idclub, $fec, $idobra, $idlocal)
    {
        /* Get membership */

        $checkerD = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE id_lec = '$request->actor' AND id_club = '$idclub' AND fec_f IS NULL"));
        $date = $checkerD[0]->fec_i;

        $pre_elenco = new Elenco_Principal();
        $pre_elenco->id_fec_mem = $date;
        $pre_elenco->id_lec = $request->actor;
        $pre_elenco->id_club = $idclub;
        $pre_elenco->id_pers = $request->personaje;
        $pre_elenco->id_obra = $idobra;
        $pre_elenco->principal = $request->main;

        /* Check just in case the same actor takes the same character in a different presentation */

        $checker = DB::select(DB::raw("SELECT * from sjl_elenco WHERE id_fec_mem = '$pre_elenco->id_fec_mem' 
        AND id_lec = '$pre_elenco->id_lec' AND id_club = '$pre_elenco->id_club' AND 
        id_pers = '$pre_elenco->id_pers' AND id_obra = '$pre_elenco->id_obra'"));

        if (!$checker)
            $pre_elenco->save();

        $elenco = new Elenco();
        $elenco->id_hist_pre = $fec;
        $elenco->id_obra = $idobra;
        $elenco->id_local = $idlocal;
        $elenco->id_club = $idclub;
        $elenco->id_lec = $request->actor;
        $elenco->id_pers = $request->personaje;
        $elenco->id_fec_mem = $date;
        $elenco->mej_act = $request->best;
        $elenco->save();

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
    public function destroy(Request $request, $idclub, $fec, $idobra, $idlocal, $idlec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar(Request $request, $idclub, $fec, $idobra, $idlocal, $idlec, $idpers)
    {
        /* Get membership */

        $checkerD = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE id_lec = '$idlec' AND id_club = '$idclub' AND fec_f IS NULL"));
        $date = $checkerD[0]->fec_i;

        DB::delete(DB::raw("DELETE FROM sjl_elenco WHERE id_fec_mem = '$date' AND id_lec = '$idlec' AND id_club = '$idclub' AND id_pers = '$idpers' AND id_obra = '$idobra'"));
        return 1;
    }
}
