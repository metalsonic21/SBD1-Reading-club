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
}
