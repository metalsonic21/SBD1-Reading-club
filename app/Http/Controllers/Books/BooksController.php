<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Book\Book;
use App\Models\Book\Editorial;
use App\Models\Book\Genre;
use App\Models\Book\Structure;
use App\Models\Book\Section;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = DB::select( DB::raw("SELECT isbn, titulo_ori, titulo_esp, tema_princ, sinop, n_pag, fec_pub, (
            SELECT titulo_esp as prev from sjl_libros WHERE isbn = id_prev
            ), (
            SELECT nom as editorial from sjl_editoriales WHERE id = id_edit
            ), autor FROM sjl_libros"));
        return view ('books.books', compact('books'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getid(Book $book)
    {
        Session::put('isbn', $book->isbn);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('sjl_editoriales')->select('id as value', 'nom as text')->get();
            $genres = DB::select( DB::raw("SELECT id as value, nom as text FROM sjl_subgeneros WHERE id_subg IS NULL"));
            $sg = DB::select( DB::raw("SELECT id || '-' || id_subg as value, nom as text FROM sjl_subgeneros WHERE id_subg IS NOT NULL"));
            $prev = DB::select( DB::raw("SELECT isbn FROM sjl_libros"));
            return Response::json(array('data'=>$data,'genres'=>$genres,'sg'=>$sg,'prev'=>$prev));
        }
        else{
            return view('books.create');
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
        $book = new Book();
        $book->isbn = $request->isbn;
        $book->titulo_esp = $request->titulo_esp;
        $book->titulo_ori = $request->titulo_ori;
        $book->tema_princ = $request->tema_princ;
        $book->sinop = $request->sinop;
        $book->n_pag = $request->n_pag;
        $book->fec_pub = $request->fec_pub;
        $book->id_edit = $request->editorial;
        $book->autor = $request->autor;
        $book->id_prev = $request->prev;
        $book->save();

        $genre = new Genre();
        $genre->id_gen = $request->genero;
        $genre->id_lib = $request->isbn;
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$genre->id_gen, $genre->id_lib]);


        /*SUBGENRE*/
        $subg = new Genre();
        $subg->id_gen = $request->subg;
        $subg->id_lib = $request->isbn;
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$subg->id_gen, $subg->id_lib]);

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $edit = DB::select( DB::raw("SELECT nom FROM sjl_editoriales WHERE id = '$book->id_edit'"))[0];
        $prev = Book::find($book->id_prev);
        $book->editorial = $edit->nom;
        $structure = DB::select(DB::raw("SELECT e.id, e.nom as ename, e.titulo as etit, e.tipo, (
            SELECT s.num FROM sjl_secciones_libros s WHERE s.id_est = e.id
        ), (
            SELECT s.titulo FROM sjl_secciones_libros s WHERE s.id_est = e.id
        ), (
            SELECT s.nom FROM sjl_secciones_libros s WHERE s.id_est = e.id
        ) FROM sjl_estructuras_libros e WHERE id_lib ='$book->isbn'"));
        return view('books.show')->with('edit', $edit)->with('book', $book)->with('prev', $prev)->with('structure', $structure);
        //return $structure;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, Book $book)
    {   

        if($request->ajax()){
            $gen = NULL;
            $subgen = NULL;

            $editoriales = DB::select(DB::raw("SELECT id as value, nom as text from sjl_editoriales"));
            $generos = DB::select(DB::raw("SELECT id as value, nom as text from sjl_subgeneros WHERE id_subg IS NULL"));
            $currentgenero = DB::select(DB::raw("SELECT g.nom as text, g.id as value from sjl_subgeneros g, sjl_generos_libros gl WHERE gl.id_lib = '$book->isbn' AND gl.id_gen = g.id AND g.id_subg IS NULL"));

            if ($currentgenero){
                $gen = $currentgenero[0]->value;
            }

            $sg = DB::select(DB::raw("SELECT g.nom as text, g.id_subg || '-' || g.id as value from sjl_subgeneros g WHERE g.id_subg IS NOT NULL"));
            $currentsubg = DB::select(DB::raw("SELECT g.nom as text, g.id_subg || '-' || g.id as value from sjl_subgeneros g, sjl_generos_libros gl WHERE gl.id_lib = '$book->isbn' AND gl.id_gen = g.id AND g.id_subg IS NOT NULL"));
            
            if ($currentsubg){
                $subgen = $currentsubg[0]->value;
            }

            return Response::json(array('data'=>$book,'editoriales'=>$editoriales,'generos'=>$generos, 'currentg'=>$gen
            ,'subgeneros'=>$sg,'currentsubg'=>$subgen));
        }
        else{
            return view('books.edit');
        }
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
        $book = new Book();
        $book->isbn = $request->isbn;
        $book->titulo_esp = $request->titulo_esp;
        $book->titulo_ori = $request->titulo_ori;
        $book->tema_princ = $request->tema_princ;
        $book->sinop = $request->sinop;
        $book->n_pag = $request->n_pag;
        $book->fec_pub = $request->fec_pub;
        $book->id_edit = $request->editorial;
        $book->autor = $request->autor;
        $book->id_prev = $request->prev;
        
        Book::where('isbn',$request->oldisbn)->update(array(
            'isbn'=> $book->isbn,
            'titulo_esp'=>$book->titulo_esp,
            'titulo_ori'=>$book->titulo_ori,
            'tema_princ'=>$book->tema_princ,
            'sinop'=>$book->sinop,
            'n_pag'=>$book->n_pag,
            'fec_pub'=>$book->fec_pub,
            'id_edit'=>$book->id_edit,
            'autor'=>$book->autor,
            'id_prev'=>$book->id_prev,
        ));

        DB::table('sjl_generos_libros')
        ->where('id_lib',$book->isbn)
        ->delete();

        $genre = new Genre();
        $genre->id_gen = $request->genero;
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$genre->id_gen, $book->isbn]);
        $subg = new Genre();
        $subg->id_gen = $request->subg;
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$subg->id_gen, $book->isbn]);

        return $genre;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('books');
    }
}
