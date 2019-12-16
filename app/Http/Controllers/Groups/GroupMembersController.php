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
            /* Get type of group to filter possible members to add */
            $members = '';
            $tg = DB::select(DB::raw("SELECT tipo FROM sjl_grupos_lectura WHERE id_club = '$club' AND id = '$grupo'"));
            $tipog = $tg[0]->tipo;

            if ($tipog == 'A'){
                $members = DB::select(DB::raw("SELECT doc_iden as documento_de_identidad, nom1 as primer_nombre, ape1 as primer_apellido, fec_nac as fecha_de_nacimiento, id_club, id_grup from sjl_lectores where (id_club='$club') and (id_grup is null) and AGE(fec_nac)>=INTERVAL'18 years';
                "));
            }

            else{
                $members = DB::select(DB::raw("SELECT doc_iden as documento_de_identidad, nom1 as primer_nombre, ape1 as primer_apellido, fec_nac as fecha_de_nacimiento, id_club, id_grup from sjl_lectores where (id_club='$club') and (id_grup is null) and AGE(fec_nac)<INTERVAL'18 years';
                "));
            }
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
        $grupo = '';
        /* How many members are in this group*/
        $c = DB::select(DB::raw("SELECT count(doc_iden) as number FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
        $count = $c[0]->number;

        /* I need what kind of group is it to evaluate partition conditions */
        $ginfo = DB::select(DB::raw("SELECT tipo, dia_sem, hora_i FROM sjl_grupos_lectura WHERE id_club = '$idclub' AND id = '$idgrupo'"));
        $tipogrupo = $ginfo[0]->tipo;
        $dia_sem = $ginfo[0]->dia_sem;
        $hora_i = $ginfo[0]->hora_i;

        if (($tipogrupo == 'A' && $count > 14) || (($tipogrupo == 'J' || $tipogrupo == 'N') && $count>9)){
            /* If name is Nohidea after the division it will be Nohidea 2*/
            $newname = DB::select(DB::raw("SELECT nom FROM sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub'"));
            $name = $newname[0]->nom;

            $newnameN = DB::select(DB::raw("SELECT count(nom) as nom FROM sjl_grupos_lectura WHERE nom LIKE (SELECT nom FROM sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub')"));
            $nameparttwo = $newnameN[0]->nom + 1;

            /* Number of groups in this club to get the ID of the new partitioned group since composite key is fucking my existence*/

            $ngrupos = DB::select(DB::raw("SELECT COUNT(id) as quantity FROM sjl_grupos_lectura WHERE id_club = '$idclub'"));
            $ng = $ngrupos[0]->quantity+1;

            $dupname = $name.'DIVISION '.$ng;

            /* Update group from 5 members if it's J/N, 7 if A*/
            $members = DB::select(DB::raw("SELECT doc_iden FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));

            if ($tipogrupo == 'A'){
                $grupo = new Grupo();
                $grupo->id = $ng;
                $grupo->id_club = $idclub;
                $grupo->nom = $dupname;
                $grupo->tipo = $tipogrupo;
                $grupo->dia_sem = $dia_sem;
                $grupo->hora_i = $hora_i;
                $grupo->hora_f = date( "H:i:s", strtotime( $grupo->hora_i ) + 2 * 3600 );
                $grupo->save();
                for ($i = 0; $i<=7; $i++){
                    Member::where('doc_iden',$members[$i]->doc_iden)->update(array(
                        'id_grup'=> $grupo->id,
                    ));

                    $aux = $members[$i]->doc_iden;

                    $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$aux' AND id_club = '$idclub'"));
                    $cm = '';
                        if ($membresia)
                            $cm = $membresia[0]->fec_i;
                    
                    /* MEMBERSHIP FOR GROUP */
                    Grupos_Lectores::where(['id_fec_mem'=>$cm,'id_club'=>$idclub,'id_lec'=>$aux,'id_grupo'=>$idgrupo])->update(array(
                        'fec_f'=> date('Y-m-d'),
                    ));
                    $gl = new Grupos_Lectores();
                    $gl->id_fec_i = date('Y-m-d');
                    $gl->id_fec_mem = $cm;
                    $gl->id_lec = $aux;
                    $gl->id_club = $idclub;
                    $gl->id_grupo = $ng;
                    $gl->save();                  
                }
            }

            /* N/J max of 10 members so I move 5 of them */
            else if ($tipogrupo == 'J' || $tipogrupo == 'N'){
                $grupo = new Grupo();
                $grupo->id = $ng;
                $grupo->id_club = $idclub;
                $grupo->nom = $dupname;
                $grupo->tipo = $tipogrupo;
                $grupo->dia_sem = $dia_sem;
                $grupo->hora_i = $hora_i;
                $grupo->hora_f = date( "H:i:s", strtotime( $grupo->hora_i ) + 2 * 3600 );
                $grupo->save();
                for ($i = 0; $i<=4; $i++){
                    Member::where('doc_iden',$members[$i]->doc_iden)->update(array(
                        'id_grup'=> $grupo->id,
                    ));

                    $aux = $members[$i]->doc_iden;

                    $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$aux' AND id_club = '$idclub'"));
                    $cm = '';
                        if ($membresia)
                            $cm = $membresia[0]->fec_i;
                    
                    /* MEMBERSHIP FOR GROUP */
                    Grupos_Lectores::where(['id_fec_mem'=>$cm,'id_club'=>$idclub,'id_lec'=>$aux,'id_grupo'=>$idgrupo])->update(array(
                        'fec_f'=> date('Y-m-d'),
                    ));
                    $gl = new Grupos_Lectores();
                    $gl->id_fec_i = date('Y-m-d');
                    $gl->id_fec_mem = $cm;
                    $gl->id_lec = $aux;
                    $gl->id_club = $idclub;
                    $gl->id_grupo = $ng;
                    $gl->save();                  
                }
            }
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
            return;
        }

        else{
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
        }
        
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

    public function borrar(Request $request, $idclub, $idgrupo, $dociden){
        $trash = null;
        Member::where('doc_iden',$dociden)->update(array(
            'id_grup'=> $trash,
        ));

        $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$dociden' AND id_club = '$idclub'"));
        $cm = '';
            if ($membresia)
                $cm = $membresia[0]->fec_i;
        
        /* MEMBERSHIP FOR GROUP */
        Grupos_Lectores::where(['id_fec_mem'=>$cm,'id_club'=>$idclub,'id_lec'=>$dociden,'id_grupo'=>$idgrupo])->update(array(
            'fec_f'=> date('Y-m-d'),
        ));

        return $dociden;
    }
}
