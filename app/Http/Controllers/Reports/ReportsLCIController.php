<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class ReportsLCIController extends Controller
{
    public function books (){

        /* Get all books in an array */
        $books = DB::select(DB::raw("SELECT l.titulo_esp, l.isbn, l.titulo_ori, l.tema_princ, l.sinop
        , l.n_pag, l.fec_pub, l.autor, 
            (SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NULL AND 
        g.id_lib = l.isbn)genero, (
            SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NOT NULL AND 
        g.id_lib = l.isbn
        )subgenero, (
            SELECT COUNT(*) from sjl_estructuras_libros e WHERE e.id_lib = l.isbn
        )estructuras
            FROM sjl_libros l
            ORDER BY l.isbn;"));

        $structures = DB::select(DB::raw("SELECT (CASE WHEN e.tipo = 'C' THEN 'Capítulo' ELSE '' END) || ' ' || s.num || ' — ' || s.nom as fullnom, e.id_lib as lib
        FROM sjl_secciones_libros s, sjl_estructuras_libros e 
        WHERE e.id = s.id_est
        ORDER BY e.id_lib, s.num; "));
        $data = [
            'books'     => $books,
            'structs' => $structures,
        ];
        $pdf = PDF::loadView('reports.base', $data);
        return $pdf->download('books.pdf');

    }

    public function club (){
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nom, (
            SELECT count (*) from sjl_grupos_lectura WHERE id_club = c.id
        )grupos, (
            SELECT count (*) FROM sjl_clubes_clubes WHERE id_club1 = c.id OR id_club2 = c.id
        )asociados FROM sjl_clubes_lectura c ORDER BY c.nom"));

        $groups = DB::select(DB::raw("SELECT g.nom, g.id as id, g.id_club as club, (CASE
        WHEN g.dia_sem = 2 THEN 'Lunes'
        WHEN g.dia_sem = 3 THEN 'Martes'
        WHEN g.dia_sem = 4 THEN 'Miercoles'
        WHEN g.dia_sem = 5 THEN 'Jueves'
        ELSE 'Viernes'
    END)dia, (select to_char(g.hora_i::time, 'HH12:MI AM')) || ' - ' || (select to_char(g.hora_f::time, 'HH12:MI AM')) as horario,
    (CASE
        WHEN g.tipo = 'A' THEN 'Adultos'
        WHEN g.tipo = 'J' THEN 'Jovenes'
        ELSE 'Niños'
    END)tipo
    FROM sjl_grupos_lectura g ORDER BY g.nom;"));

        $associated = DB::select(DB::raw("SELECT a.id_club1 as idone, a.id_club2 as idtwo, (SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club1)clubone, (
            SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club2
        )clubtwo FROM sjl_clubes_clubes a;"));

        $data = [
            'clubs'     => $clubs,
            'grupos' => $groups,
            'associated' => $associated,
        ];
        $pdf = PDF::loadView('reports.club_info', $data);
        return $pdf->download('clubs.pdf');
    }

    public function CatchThirtythree(){
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nom, (
            SELECT count(*) from sjl_membresias m WHERE m.id_club = c.id AND m.fec_f IS NOT NULL AND m.motivo_b = 'I'
        )i FROM sjl_clubes_lectura c ORDER BY c.nom"));

        $na = DB::select(DB::raw("SELECT (
            SELECT nom1 || ' ' || ape1 from sjl_lectores WHERE doc_iden = m.id_lec
        )victim, 
        (
            SELECT doc_iden from sjl_lectores WHERE doc_iden = m.id_lec
        )victimid,
        m.id_club FROM sjl_membresias m WHERE m.fec_f IS NOT NULL AND m.motivo_b = 'I'"));

        $data = [
            'clubs'     => $clubs,
            'na' => $na,
        ];
        $pdf = PDF::loadView('reports.30', $data);
        return $pdf->download('30.pdf');

        //return view ('reports.30')->with('clubs',$clubs)->with('na',$na);
    }
    public function cronoMembers(){
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom, c.fec_crea,
        (SELECT count (*) FROM sjl_membresias WHERE c.id = id_club) as n_miembros
        FROM sjl_clubes_lectura c ORDER BY fec_crea;"));

        $members = DB::select(DB::raw("SELECT m.fec_i, m.id_lec, m.id_club,
        (SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE m.id_lec = doc_iden ) as fullnom,
        (SELECT count (*) FROM sjl_reuniones_mensuales WHERE m.id_lec = id_lec AND m.id_club = id_club AND n_ses = 1) as n_libros      
        FROM sjl_membresias m
        ORDER BY m.fec_i;"));

        $books = DB::select(DB::raw("SELECT l.isbn, l.titulo_ori, r.id_club,r.id_lec FROM sjl_libros l, sjl_reuniones_mensuales r WHERE r.id_lib = l.isbn AND n_ses = 1 "));

        $data = [
            'clubs' => $clubs,
            'members' => $members,
            'books' => $books,
        ];
        $pdf = PDF::loadView('reports.crono_members', $data);
        return $pdf->download('Ficha_cronologica_club.pdf');
    }

    public function meetings(){
        
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom, c.fec_crea FROM sjl_clubes_lectura c;"));

        $groups = DB::select(DB::raw("SELECT g.id,g.id_club,g.nom,
            (SELECT count (*) FROM sjl_reuniones_mensuales WHERE g.id = id_grupo ) as n_reu
            FROM sjl_grupos_lectura g;"));

        $meetings = DB::select(DB::raw("SELECT r.fec,r.id_grupo,r.n_ses,r.conclu,r.valor,(
            SELECT titulo_ori FROM sjl_libros WHERE r.id_lib = isbn),(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE r.id_lec = doc_iden
            ) as moder
            FROM sjl_reuniones_mensuales r ORDER BY r.fec;"));

        $members = DB::select(DB::raw("SELECT r.fec, r.id_grupo,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE gl.id_lec = doc_iden
            ) as fullnom, (CASE WHEN EXISTS(SELECT fec_reu_men from sjl_inansistencias WHERE fec_reu_men = r.fec AND id_lec = gl.id_lec) THEN 'I' ELSE 'A' END) as asistencia
            FROM sjl_reuniones_mensuales r , sjl_grupos_lectores gl
            WHERE r.fec > gl.id_fec_i and r.id_grupo = gl.id_grupo and (CASE WHEN gl.fec_f IS NOT NULL THEN r.fec < gl.fec_f ELSE TRUE END)
            ORDER BY fullnom;"));

        $data = [
            'clubs' => $clubs,
            'groups' => $groups,
            'meetings' => $meetings,
            'members' => $members,
        ];
        $pdf = PDF::loadView('reports.meetings', $data);
        return $pdf->download('Ficha_reuniones.pdf');
    }

    public function presentations(){

        $clubs = DB::select(DB::raw("SELECT c.id, c.nom,(SELECT count (*) FROM sjl_historicos_presentaciones WHERE id_club = c.id) as n_pres
            FROM sjl_clubes_lectura c;")); 

        $presentations = DB::select(DB::raw("SELECT p.fec,p.hora_i,p.durac,p.id_club,p.valor,p.id_obra,(
            SELECT nom FROM sjl_obras WHERE id = p.id_obra) as obra,(
            SELECT nom FROM sjl_locales_eventos WHERE id = p.id_local) as lcl,(
            SELECT count (*) FROM sjl_elenco_lectores e WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE ) as n_act
            FROM sjl_historicos_presentaciones p;"));

        $actors = DB::select(DB::raw("SELECT p.fec, p.id_obra, p.id_club,(
            SELECT nom FROM sjl_personajes WHERE id = e.id_pers) AS pers,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE e.id_lec = doc_iden) as fullnom
            FROM sjl_elenco_lectores e, sjl_historicos_presentaciones p
            WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE;"));

        $data = [
            'clubs' => $clubs,
            'presentations' => $presentations,
            'actors' => $actors,
        ];
        $pdf = PDF::loadView('reports.presentations',$data);
        return $pdf->download('Presentaciones.pdf');
    }
}

