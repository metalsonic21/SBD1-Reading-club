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
        )subgenero
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
}
