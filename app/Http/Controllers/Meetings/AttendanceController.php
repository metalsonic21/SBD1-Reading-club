<?php

namespace App\Http\Controllers\Meetings;
use DB;
use Response;
use App\Models\Meeting\Inasistencia;
use App\Models\Member\Member;
use App\Models\Member\Membresia;
use App\Models\Grupo\Grupos_Lectores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyA($idclub, $idgrupo, $idreunion, $idmod, $idlibro, Request $request)
    {
        $checker = DB::select(DB::raw("SELECT count(*) FROM sjl_inansistencias WHERE id_club = '$idclub' AND id_grupo = '$idgrupo' AND fec_reu_men = '$idreunion'"));
        /* If non attendances were already registered throw an error */
        return ($checker[0]->count);
    }

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
        $retired_members = [];
        $retired = 0;

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

                /* Calculate if this member has >30% of non attendance the last 2 months */
                // Step 1: Calculate how many meetings this group had in the last two months
                // Step 2: Calculate the number of non attendance of this member
                // Step 3: Calculate the percentage of non attendance
                // Step 4: Compare with 30%

                $checkerT = DB::select(DB::raw("SELECT count(*) FROM sjl_reuniones_mensuales WHERE id_grupo = '$idgrupo' AND fec > CURRENT_DATE - INTERVAL '2 months'"));
                $total = $checkerT[0]->count;
                $checkerN = DB::select(DB::raw("SELECT count (*) from sjl_inansistencias WHERE id_grupo = '$idgrupo' AND id_lec = '$falta->id_lec' AND fec_reu_men > CURRENT_DATE - INTERVAL '2 months'"));
                $totalI = $checkerN[0]->count;
                
                $percentage = 0;
                if ($total != 0){
                    $percentage = ($totalI*100)/$total;
                }
                
                /* Delete member if >30% non attendance */
                if ($percentage>30){
                    $namelect = DB::select(DB::raw("SELECT nom1 || ' ' || ape1 as name FROM sjl_lectores WHERE doc_iden = '$falta->id_lec'"));
                    $name = $namelect[0]->name;
                    $retired_members[$retired] = $name;
                    $retired++;
                    $trash = null;
                    $trash2 = '';
                    Member::where('doc_iden',$falta->id_lec)->update(array(
                        'id_club'=> $trash,
                        'id_grup'=> $trash,
                    ));
            
                    /* MEMBERSHIP */
                    Membresia::where(['id_lec'=>$falta->id_lec,'id_club'=>$idclub,'fec_f'=>$trash])->update(array(
                        'fec_f'=>date('Y-m-d'),
                        'estatus'=>'I',
                        'motivo_b'=>'I',
                    ));

                    /* MEMBERSHIP FOR GROUP */
                    Grupos_Lectores::where(['id_fec_mem'=>$falta->id_fec_mem,'id_club'=>$idclub,'id_lec'=>$falta->id_lec,'id_grupo'=>$idgrupo])->update(array(
                    'fec_f'=> date('Y-m-d'),
                    ));
                }
            }
        }
        return $retired_members;
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
