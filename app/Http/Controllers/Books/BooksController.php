<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Editorial;
use App\Models\Genre;

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
            $prev = DB::table('sjl_libros')->select('isbn as value', 'titulo_esp as text')->get();
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
        $prev = DB::select( DB::raw("SELECT titulo_esp FROM sjl_libros WHERE isbn = '$book->id_prev'"))[0];
        $book->editorial = $edit->nom;
        $book->prev = $prev->titulo_esp;
        return view ('books.show', compact('book'));
        //return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {   
        $edit = DB::select( DB::raw("SELECT nom FROM sjl_editoriales WHERE id = '$book->id_edit'"))[0];
        $book->editorial = $edit->nom;

        $editoriales = DB::select( DB::raw("SELECT id, nom FROM sjl_editoriales"));

        $generos = DB::select( DB::raw("SELECT id, nom FROM sjl_subgeneros WHERE id_subg IS NULL"));
        $currentgenero = DB::select(DB::raw("SELECT x.id_lib, (
            SELECT sg.nom FROM sjl_subgeneros sg WHERE (x.id_gen = sg.id)
        )as genname, x.id_gen
            FROM sjl_generos_libros x WHERE x.id_lib = '$book->isbn' AND (
            SELECT sg.id FROM sjl_subgeneros sg WHERE (x.id_gen = sg.id) AND (sg.tipo LIKE 'SG%')
        ) IS NULL"));
        $aux = $currentgenero[0]->id_gen;
        $subgeneros = DB::select(DB::raw("SELECT id, nom FROM sjl_subgeneros WHERE id_subg = '$aux'"));
                
        $currentsubg = DB::select(DB::raw("SELECT x.id_lib, (
            SELECT sg.nom FROM sjl_subgeneros sg WHERE (x.id_gen = sg.id)
        )as genname, x.id_gen
            FROM sjl_generos_libros x WHERE x.id_lib = '$book->isbn' AND (
            SELECT sg.id FROM sjl_subgeneros sg WHERE (x.id_gen = sg.id) AND (sg.tipo LIKE 'SG%')
        ) IS NOT NULL"));

        return view('books.edit')->with('book', $book)->with('editoriales', $editoriales)->with('generos', $generos)->with('currentgenero', $currentgenero)->with('subgeneros', $subgeneros)->with('currentsubg', $currentsubg);
        //return $currentsubg;
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
        DB::table('sjl_libros')
            ->where('isbn', $book->isbn)
            ->update(['titulo_esp'=>$book->titulo_esp], ['titulo_ori'=>$book->titulo_ori],['id_edit'=>$book->id_edit],['tema_princ'=>$book->tema_princ],
        ['sinop'=>$book->sinop],['n_pag'=>$book->n_pag],['fec_pub'=>$book->fec_pub],['isbn'=>$book->isbn]);

        $id_gen = $request->input('genero');
        $id_subg = $request->input('subgenero');

        DB::table('sjl_generos_libros')
            ->where('id_lib',$book->isbn)
            ->delete();
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$id_gen, $book->isbn]);
        DB::insert('INSERT INTO sjl_generos_libros (id_gen, id_lib) values (?, ?)', [$id_subg, $book->isbn]);
        //DB::statement("UPDATE favorite_contents, contents SET favorite_contents.type = contents.type where favorite_contents.content_id = contents.id");

        return $book;
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
        return redirect()->action('\Books\BooksController@index');
    }
}
