<?php

namespace App\Http\Controllers\Groups;
use App\Models\Grupo;
use App\Models\Member;
use App\Models\Membresia;
use App\Models\Grupos_Lectores;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, $idgrupo, Request $request)
    {
        if($request->ajax()){
            $members = DB::select(DB::raw("SELECT doc_iden, nom1, ape1, fec_nac, id_club, id_grup FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
            $g = DB::select(DB::raw("SELECT nom FROM sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub'"));
            $grupo = $g[0]->nom; 
            return Response::json(array('data'=>$members, 'grupo'=>$grupo));
        }
        else{
            return view('groups.members');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($club, $grupo, Request $request)
    {
        if($request->ajax()){
            $members = DB::select(DB::raw("SELECT doc_iden as documento_de_identidad, nom1 as primer_nombre, ape1 as primer_apellido, fec_nac as fecha_de_nacimiento, id_club, id_grup FROM sjl_lectores WHERE id_club = '$club' AND id_grup IS NULL"));
            return Response::json(array('data'=>$members));
        }
        else{
            return view('groups.addmember');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idclub, $idgrupo, $dociden)
    {
        Member::where('doc_iden',$dociden)->update(array(
            'id_grup'=> $idgrupo,
        ));

        $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$dociden' AND id_club = '$idclub'"));
        $cm = $membresia[0]->fec_i;
        
        /* MEMBERSHIP FOR GROUP */

        $gl = new Grupos_Lectores();
        $gl->id_fec_i = date('Y-m-d');
        $gl->id_fec_mem = $cm;
        $gl->id_lec = $dociden;
        $gl->id_club = $idclub;
        $gl->id_grupo = $idgrupo;
        $gl->save();

        return $gl;
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
