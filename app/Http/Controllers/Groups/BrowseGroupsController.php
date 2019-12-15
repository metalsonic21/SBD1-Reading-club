<?php

namespace App\Http\Controllers\Groups;
use App\Models\Grupo;
use App\Models\Grupos_Lectores;
use App\Models\Inasistencia;
use App\Models\Member;
use App\Http\Controllers\Controller;
use DB;
use Response;
use Illuminate\Http\Request;

class BrowseGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($club, Request $request)
    {
        $groups = DB::select(DB::raw("SELECT nom, id_club, id, tipo, dia_sem, (select to_char(hora_i::time, 'HH12:MI AM')) || ' - ' || (select to_char(hora_f::time, 'HH12:MI AM')) as horario FROM sjl_grupos_lectura WHERE id_club = '$club'"));
        return view ('groups.browse')->with('groups',$groups)->with('club',$club);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($club, Request $request)
    {
        if($request->ajax()){
            $ngrupos = DB::select(DB::raw("SELECT COUNT(id) FROM sjl_grupos_lectura WHERE id_club = '$club'"));
            return $ngrupos;
        }
        else{
            return view('groups.creategroup');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idclub)
    {
        $grupo = new Grupo();
        $grupo->id = $request->count;
        $grupo->id_club = $idclub;
        $grupo->nom = $request->nom;
        $grupo->tipo = $request->tipo;
        $grupo->dia_sem = $request->dia;
        $grupo->hora_i = $request->horai;
        $grupo->hora_f = date( "H:i:s", strtotime( $grupo->hora_i ) + 2 * 3600 );
        $grupo->save();
        return $grupo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idclub, $idgrupo)
    {
        $g = DB::select(DB::raw("SELECT nom, tipo, dia_sem as dia, (
            SELECT to_char(hora_i::time, 'HH12:MI AM')
        )horai,(
            SELECT to_char(hora_f::time, 'HH12:MI AM')
        )horaf, (
            SELECT count(id_fec_i) FROM sjl_grupos_lectores WHERE fec_f IS NULL AND id_club = '$idclub' AND id_grupo = '$idgrupo'
        )miembros FROM sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub'"));
        $grupo = $g[0];
        return view('groups.showgroup')->with('g',$grupo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($club, $group, Request $request)
    {
        if($request->ajax()){
            $g = DB::select(DB::raw("SELECT id, id_club, nom, tipo, dia_sem as dia, hora_i as horai FROM sjl_grupos_lectura WHERE id = '$group' AND id_club = '$club'"));
            return Response::json(array('data'=>$g));
        }
        else{
            return view('groups.editgroup');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idclub, $idgrupo)
    {
        $grupo = new Grupo();
        $grupo->id_club = $idclub;
        $grupo->nom = $request->nom;
        $grupo->tipo = $request->tipo;
        $grupo->dia_sem = $request->dia;
        $grupo->hora_i = $request->horai;
        $grupo->hora_f = date( "H:i:s", strtotime( $grupo->hora_i ) + 2 * 3600 );


        Grupo::where(['id'=>$idgrupo,'id_club'=>$idclub])->update(array(
            'nom'=> $grupo->nom,
            'tipo'=>$grupo->tipo,
            'dia_sem'=>$grupo->dia_sem,
            'hora_i'=>$grupo->hora_i,
            'hora_f'=>$grupo->hora_f,
        ));
        return $grupo;    
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function borrar(Request $request, $idclub, $idgrupo){
        $trash = null;

        Member::where(['id_grup'=>$idgrupo, 'id_club'=>$idclub])->update(array(
            'id_grup'=> $trash,
        ));

        /* MEMBERSHIP FOR GROUP */
        Grupos_Lectores::where(['fec_f'=>$trash,'id_club'=>$idclub,'id_grupo'=>$idgrupo])->update(array(
            'fec_f'=> date('Y-m-d'),
        ));

        $grupo = Grupo::find($idgrupo);
        $grupo->delete();
        return redirect()->route('groups.index', [$idclub]);

     }
}
