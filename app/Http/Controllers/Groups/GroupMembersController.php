<?php

namespace App\Http\Controllers\Groups;
use App\Models\Grupo;
use App\Models\Member;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, $idgrupo)
    {
        $members = DB::select(DB::raw("SELECT doc_iden, nom1, ape1, fec_nac FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
        $g = DB::select(DB::raw("SELECT nom FROM sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub'"));
        $grupo = $g[0]->nom; 
        return view ('groups.members')->with('members',$members)->with('grupo',$grupo);
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
        return view ('groups.editmember');
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
