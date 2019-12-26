<?php

namespace App\Http\Controllers\Meetings;
use App\Models\Meeting\Reunion;
use App\Models\Meeting\Inasistencia;
use DB;
use Log;
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
                ) libro,(
                    SELECT isbn FROM sjl_libros WHERE isbn = r.id_lib
                ) idlibro, r.fec as fecha, (
                    SELECT nom1 || ' ' || ape1 FROM sjl_lectores WHERE doc_iden = r.id_lec 
                ) moderador , (
                    SELECT doc_iden FROM sjl_lectores WHERE doc_iden = r.id_lec 
                ) idmod , r.n_ses as sesion, r.valor as valoracion FROM sjl_reuniones_mensuales r WHERE r.id_club = '$idclub' AND r.id_grupo = '$idgrupo'"));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function verifyAdd($idclub, $idgrupo, Request $request){
        $checkerM = DB::select(DB::raw("SELECT count(id_fec_i) FROM sjl_grupos_lectores WHERE fec_f IS NULL AND id_club = '$idclub' AND id_grupo = '$idgrupo'"));
        $typeG = DB::select(DB::raw("SELECT tipo from sjl_grupos_lectura WHERE id_club = '$idclub' AND id = '$idgrupo'"));
        
        $miembros = $checkerM[0]->count;
        $tipo = $typeG[0]->tipo;

        if ($tipo == 'A' && $miembros<10) return 0;
        if ($tipo == 'J' && $miembros<5) return 2;
        if ($tipo == 'N' && $miembros<7) return 3;
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idclub, $idgrupo, Request $request)
    {
        if ($this->verifyAdd($idclub,$idgrupo,$request)!=1){
            return view ('error.402');
        }

        else{
            if($request->ajax()){

                /* Get type of group */
                $member = '';
                $type = DB::select(DB::raw("SELECT tipo from sjl_grupos_lectura WHERE id = '$idgrupo' AND id_club = '$idclub'"));
                $typeg = $type[0]->tipo;

                if ($typeg == 'A'){
                $members = DB::select(DB::raw("SELECT nom1 || ' ' || ape1 as text, doc_iden as value FROM sjl_lectores WHERE id_club = '$idclub' AND id_grup = '$idgrupo'"));
                }

                else {
                    $members = DB::select(DB::raw("SELECT l.nom1 || ' ' || l.ape1 as text, l.doc_iden as value FROM sjl_lectores l WHERE '$idclub'=(SELECT h.id_club FROM sjl_grupos_lectura h WHERE (l.id_grup=h.id)AND(h.tipo='A')) "));
                }
                $libros = DB::select(DB::raw("SELECT l.isbn as id, l.titulo_esp as titulo_en_español, l.titulo_ori as titulo_original, l.fec_pub as fecha_de_publicacion, l.autor FROM sjl_libros l WHERE NOT EXISTS (
                    SELECT id_lib FROM sjl_reuniones_mensuales WHERE id_club = '$idclub' AND id_grupo = '$idgrupo' AND n_ses = 1 AND id_lib = l.isbn
                )"));
                return Response::json(array('data'=>$members,'libros'=>$libros));
            }
            else{
                return view('meetings.create');
            }
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
        $reunion = '';
        /* If there are meetings select the last one generated to generate one the month after that one*/
        $nextr = DB::select(DB::raw("SELECT fec FROM sjl_reuniones_mensuales WHERE fec IN (SELECT max(fec) FROM sjl_reuniones_mensuales WHERE id_club = '$idclub' AND id_grupo = '$idgrupo')"));
            if ($nextr){
                /* If there hasn't been any meeting in a while you have to set the next meeting from this date to the next available day */
                $today = strtotime(date('Y-m-d'));
                $basedate = $nextr[0]->fec;
                $basedate = strtotime(($basedate));
                $datediff = $today-$basedate;
                $datediff = ($datediff / (60 * 60 * 24));

                if ($datediff > 7) $nextr = DB::select(DB::raw("SELECT CURRENT_DATE as fec"));
            }

        /* First meeting */
        else $nextr = DB::select(DB::raw("SELECT CURRENT_DATE as fec"));
        $basedate = $nextr[0]->fec;

        /* I need the group's available day to set the next meeting */
        $ginfo = DB::select(DB::raw("SELECT dia_sem as dia, tipo as tipo FROM sjl_grupos_lectura WHERE id_club = '$idclub' AND id = '$idgrupo'"));
        $dia = $ginfo[0]->dia-1;

        /* Next meeting date set */

        $effectiveDate = date('Y-m-d', strtotime("+7 day", strtotime($basedate)));            
        $nextm = DB::select(DB::raw("SELECT '$effectiveDate'::date + ( '$dia' + 7 - extract ( dow FROM '$effectiveDate'::date))::int%7 as date"));
        $ED = $nextm[0]->date;
        $ED2 = date('Y-m-d', strtotime("+7 day", strtotime($ED)));
        $ED3 = date('Y-m-d', strtotime("+7 day", strtotime($ED2)));


        $fechas = array($ED, $ED2, $ED3);
        /* Select actual membership for grupos_lectores */
        $am = DB::select(DB::raw("SELECT id_fec_i as fi FROM sjl_grupos_lectores WHERE id_lec = '$request->moderador' AND id_club = '$idclub' AND fec_f IS NULL"));
        $actualg = $am[0]->fi;
        /* Select actual membership for membership */
        $amc = DB::select(DB::raw("SELECT fec_i as fi FROM sjl_membresias WHERE id_lec = '$request->moderador' AND id_club = '$idclub' AND fec_f IS NULL"));
        $actualc = $amc[0]->fi;

        /* Select type of group so I know what to do with idgrupo */
        $gtipo = $ginfo[0]->tipo;

        if ($gtipo == 'A'){
            for ($i = 1; $i<=$request->sesion; $i++){
                $reunion = new Reunion();
                $reunion->fec = $fechas[$i-1];
                $reunion->id_lib = $request->libro;
                $reunion->id_grupo = $idgrupo;
                $reunion->id_fec_i = $actualg;
                $reunion->id_fec_mem = $actualc;
                $reunion->id_club = $idclub;
                $reunion->id_lec = $request->moderador;
                $reunion->n_ses = $i;
                $reunion->id_grupo_mod = $idgrupo;
                $reunion->save();
            }
        }

        /* Get moderator's id group to avoid problems with foreign keys */
        else if ($gtipo != 'A'){
            $amg = DB::select(DB::raw("SELECT id_grup as grupo FROM sjl_lectores WHERE doc_iden = '$request->moderador' AND id_club = '$idclub'"));
            $actualidg = $amg[0]->grupo;
            for ($i = 1; $i<=$request->sesion; $i++){
                $reunion = new Reunion();
                $reunion->fec = $fechas[$i-1];
                $reunion->id_lib = $request->libro;
                $reunion->id_grupo_mod = $actualidg;
                $reunion->id_grupo = $idgrupo;
                $reunion->id_fec_i = $actualg;
                $reunion->id_fec_mem = $actualc;
                $reunion->id_club = $idclub;
                $reunion->id_lec = $request->moderador;
                $reunion->n_ses = $i;
                $reunion->save();
            }
        }
        return Response::json(array('f1'=>$ED,'f2'=>$ED2, 'f3'=>$ED3));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($idclub, $idgrupo, $idreunion, $idmod, $idlibro, $nses)
    {
        $meeting = DB::select(DB::raw("SELECT (
            SELECT titulo_esp FROM sjl_libros WHERE isbn = '$idlibro'
        )titulo, r.fec as fecha , (
            SELECT to_char(g.hora_i::time, 'HH12:MI AM') FROM sjl_grupos_lectura g WHERE g.id_club = '$idclub' AND g.id = '$idgrupo'
        )hora_i,(
            SELECT to_char(g.hora_f::time, 'HH12:MI AM') FROM sjl_grupos_lectura g WHERE g.id_club = '$idclub' AND g.id = '$idgrupo'
        )hora_f, (
            SELECT nom1 || ' ' || ape1 FROM sjl_lectores WHERE doc_iden = r.id_lec
        )moderador, r.n_ses, r.conclu, r.valor FROM sjl_reuniones_mensuales r WHERE r.n_ses='$nses' AND r.id_club = '$idclub' AND r.id_grupo = '$idgrupo'"));

        $m = $meeting[0];
        $inas = '';
        $inas = DB::select(DB::raw("SELECT nom1 || ' ' || ape1 as nombre FROM sjl_lectores, sjl_inansistencias r WHERE doc_iden = r.id_lec AND r.id_grupo = '$idgrupo' AND r.id_club = '$idclub' AND r.fec_reu_men = '$idreunion'"));
        return view('meetings.details')->with('meeting',$m)->with('inas', $inas);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modificar($idclub, $idgrupo, $idreunion, $idmod, $idlibro, Request $request)
    {
        if($request->ajax()){
            $nsession = DB::select(DB::raw("SELECT n_ses as n FROM sjl_reuniones_mensuales WHERE id_lec = '$idmod' AND id_club = '$idclub' AND fec = '$idreunion' "));
            $n = $nsession[0]->n;

            $limit = DB::select(DB::raw("SELECT max(n_ses) as limit FROM sjl_reuniones_mensuales WHERE id_lib = '$idlibro' and id_lec = '$idmod' and id_club = '$idclub'"));
            $l = $limit[0]->limit;

            return Response::json(array('actuals'=>$n, 'limit'=>$l));

        }
        
        else{
            return view('meetings.edit');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idclub, $idgrupo, $idreunion, $idmod, $idlibro)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function concluir(Request $request, $idclub, $idgrupo, $idreunion, $idmod, $idlibro)
    {
        /* UPDATE */
        Reunion::where(['fec'=>$idreunion,'id_lib'=>$idlibro,'id_lec'=>$idmod, 'id_club'=>$idclub])->update(array(
            'conclu'=>$request->conclusion,
            'valor'=>$request->valoracion,
        ));

        /* DELETE EXTRA SESSIONS */
        DB::delete("DELETE FROM sjl_reuniones_mensuales WHERE n_ses > '$request->ses' AND id_club = '$idclub' AND id_grupo = '$idgrupo' AND id_grupo_mod = '$idmod'");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idclub, $idgrupo, $idreunion)
    {
        DB::delete("DELETE FROM sjl_reuniones_mensuales WHERE id_club = '$idclub' AND id_grupo = '$idgrupo' AND fec = '$idreunion'");
        return 1;
    }
}
