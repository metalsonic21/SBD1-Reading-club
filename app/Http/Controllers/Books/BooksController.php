<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
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
    public function index()
    {
        return view ('books.books');
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
    public function show($id)
    {
        return view ('books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view ('books.edit');
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
