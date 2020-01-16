<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Redirect;
use PDF;
use Log;

class ReportsJController extends Controller
{
    public function cronoMemberspdf($id,$fec_i,$fec_f){      
        $member = DB::select(DB::raw("SELECT nom1 || ' ' || (CASE WHEN nom2 IS NOT NULL THEN nom2 || ' '  ELSE '' END) || ape1 || ' ' || ape2 as fullnom FROM sjl_lectores WHERE doc_iden = '$id';"));

        $clubs = DB::select(DB::raw("SELECT fec_i,fec_f,id_club,(
            SELECT nom FROM sjl_clubes_lectura WHERE id = id_club) as nom
            FROM sjl_membresias WHERE id_lec = '$id' AND fec_i >= '$fec_i' AND (CASE WHEN fec_f IS NOT NULL THEN fec_f <= '$fec_f' ELSE TRUE END)
            ORDER BY fec_i;"));

        $groups = DB::select(DB::raw("SELECT id_fec_i as fec_i,fec_f,id_club,id_grupo,(
            SELECT nom FROM sjl_grupos_lectura WHERE id = id_grupo) as nom
            FROM sjl_grupos_lectores WHERE id_lec ='$id' AND id_fec_i >= '$fec_i' AND (CASE WHEN fec_f IS NOT NULL THEN fec_f <= '$fec_f' ELSE TRUE END)
            ORDER BY id_fec_i;"));

        $books = DB::select(DB::raw("SELECT rm.fec,rm.id_club,rm.id_grupo,(
            SELECT titulo_ori FROM sjl_libros WHERE isbn = id_lib ) as libro 
            from sjl_reuniones_mensuales rm, sjl_grupos_lectores gl
            WHERE rm.n_ses = 1 AND rm.id_grupo = gl.id_grupo and gl.id_lec ='$id';"));

        $data = [
            'clubs' => $clubs,
            'member' => $member[0],
            'groups' => $groups,
            'books' => $books,
        ];
        Log::info($data);
        $pdf = PDF::loadView('reports.crono_members', $data);
        return $pdf->download('Ficha_cronologica_club.pdf');
    }

    public function cronoMembers (Request $request){
       # return $this->cronoMemberspdf($request->doc,$request->fec_i,$request->fec_f);
    }

    public function meetingspdf($id,$fec_i,$fec_f){
        
        $club = DB::select(DB::raw("SELECT c.id, c.nom, c.fec_crea FROM sjl_clubes_lectura c WHERE c.id='$id';"));

        $groups = DB::select(DB::raw("SELECT g.id,g.id_club,g.nom,
            (SELECT count (*) FROM sjl_reuniones_mensuales WHERE g.id = id_grupo ) as n_reu
            FROM sjl_grupos_lectura g;"));

        $meetings = DB::select(DB::raw("SELECT r.fec,r.id_grupo,r.n_ses,r.conclu,r.valor,(
            SELECT titulo_ori FROM sjl_libros WHERE r.id_lib = isbn),(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE r.id_lec = doc_iden
            ) as moder
            FROM sjl_reuniones_mensuales r WHERE r.fec >= '$fec_i' AND r.fec <= '$fec_f'
            ORDER BY r.fec;"));

        $members = DB::select(DB::raw("SELECT r.fec, r.id_grupo,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE gl.id_lec = doc_iden
            ) as fullnom, (CASE WHEN EXISTS(SELECT fec_reu_men from sjl_inansistencias WHERE fec_reu_men = r.fec AND id_lec = gl.id_lec) THEN 'I' ELSE 'A' END) as asistencia
            FROM sjl_reuniones_mensuales r , sjl_grupos_lectores gl
            WHERE r.fec > gl.id_fec_i and r.id_grupo = gl.id_grupo and (CASE WHEN gl.fec_f IS NOT NULL THEN r.fec < gl.fec_f ELSE TRUE END)
            ORDER BY fullnom;"));

        $data = [
            'club' => $club[0],
            'groups' => $groups,
            'meetings' => $meetings,
            'members' => $members,
        ];
        $pdf = PDF::loadView('reports.meetings', $data);
        return $pdf->download('Ficha_reuniones.pdf');
    }

    public function meetings (Request $request){
        # return $this->meetingspdf($request->id,$request->fec_i,$request->fec_f);
    }

    public function presentationspdf($id,$fec_i,$fec_f){

        $club = DB::select(DB::raw("SELECT c.id, c.nom,(SELECT count (*) FROM sjl_historicos_presentaciones WHERE id_club = c.id) as n_pres
            FROM sjl_clubes_lectura c
            WHERE c.id = '$id';")); 

        $presentations = DB::select(DB::raw("SELECT p.fec,p.hora_i,p.durac,p.id_club,p.valor,p.id_obra,(
            SELECT nom FROM sjl_obras WHERE id = p.id_obra) as obra,(
            SELECT nom FROM sjl_locales_eventos WHERE id = p.id_local) as lcl,(
            SELECT count (*) FROM sjl_elenco_lectores e WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE ) as n_act
            FROM sjl_historicos_presentaciones p
            WHERE p.fec >= '$fec_i' AND p.fec <= '$fec_f'
            ORDER BY p.fec;"));

        $actors = DB::select(DB::raw("SELECT p.fec, p.id_obra, p.id_club,(
            SELECT nom FROM sjl_personajes WHERE id = e.id_pers) AS pers,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE e.id_lec = doc_iden) as fullnom
            FROM sjl_elenco_lectores e, sjl_historicos_presentaciones p
            WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE;"));

        $data = [
            'club' => $club[0],
            'presentations' => $presentations,
            'actors' => $actors,
        ];
        $pdf = PDF::loadView('reports.presentations',$data);
        return $pdf->download('Presentaciones.pdf');
    }

    public function presentations(Request $request){
        # return $this->presentationspdf($request->id,$request->fec_i,$request->fec_f);
    }

}


