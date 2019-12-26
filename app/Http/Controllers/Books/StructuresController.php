<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book\Structure;
use Response;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Book\Section;
use App\Models\Book\Book;

class StructuresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($isbn, Request $request)
    {
        $name = DB::select(DB::raw("SELECT titulo_esp FROM sjl_libros WHERE isbn = '$isbn'"));
        $name = $name[0]->titulo_esp;
        $fullstructure = DB::select(DB::raw("SELECT e.id, e.nom as structname, (
            SELECT nom from sjl_secciones_libros  WHERE id_est = e.id
        ), (
            SELECT num from sjl_secciones_libros WHERE id_est = e.id
        ), (
            SELECT titulo from sjl_secciones_libros WHERE id_est = e.id
        ) FROM sjl_estructuras_libros e WHERE e.id_lib = '$isbn'"));
        //return $fullstructure;
        return view('books.structindex')->with('isbn', $isbn)->with('name', $name)->with('fullstructure', $fullstructure);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $isbn)
    {
        return view ('books.structcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $isbn)
    {
        $structure = new Structure();
        $structure->id_lib = $isbn;
        $structure->nom = $request->nom;
        $structure->tipo = $request->tipo;
        $structure->titulo = $request->titulo;
        $structure->save();

        $section = new Section();
        $section->id_est = $structure->id;
        $section->id_lib = $isbn;
        $section->nom = $request->secnom;
        $section->num = $request->num;
        $section->titulo = $request->sectit;
        $section->save();
        return $section;
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
    public function edit($isbn, $id, Request $request)
    {
        if($request->ajax()){
            $structure = new Structure();
            
            $structure = DB::select(DB::raw("SELECT e.id, e.nom as structname, (
                SELECT nom from sjl_secciones_libros  WHERE id_est = e.id
            ), (
                SELECT num from sjl_secciones_libros WHERE id_est = e.id
            ), (
                SELECT titulo from sjl_secciones_libros WHERE id_est = e.id
            ), e.titulo as structit, e.tipo FROM sjl_estructuras_libros e WHERE e.id_lib = '$isbn'"));
            return Response::json(array('data'=>$structure));
        }
        else{
            return view('books.structedit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $ide)
    {
        $structure = Structure::find($ide);
        $structure->nom = $request->nom;
        $structure->tipo = $request->tipo;
        $structure->titulo = $request->titulo;
        $structure->save();

        $section = Section::find($ide);
        $section->nom = $request->secnom;
        $section->num = $request->num;
        $section->titulo = $request->sectit;
        $section->save();

        return Response::json(array('data'=>$section));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $isbn)
    {
        DB::delete("DELETE from sjl_secciones_libros WHERE id_lib = '$id' AND id_est = '$isbn'");
        DB::delete("DELETE from sjl_estructuras_libros WHERE id_lib = '$id' AND id = '$isbn'");
        return redirect()->route('structure.index', [$id]);
        }
}
