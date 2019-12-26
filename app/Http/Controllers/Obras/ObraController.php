<?php

namespace App\Http\Controllers\Obras;
use DB;
use Response;
use App\Models\Obra\Obra;
use App\Models\Obra\Obras_Libros;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $obras = DB::select(DB::raw("SELECT o.id, o.nom, o.resum, (
            SELECT l.titulo_esp FROM sjl_libros l WHERE l.isbn = ol.id_lib AND o.id = ol.id_obra
        )libro FROM sjl_obras o, sjl_obras_libros ol WHERE o.id = ol.id_obra"));
        if($request->ajax()){
            return Response::json(array('data'=>$obras));
        }
        else{
            return view('obras.all');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $books = DB::select(DB::raw("SELECT isbn, titulo_esp as titulo_en_español, titulo_ori as titulo_original, fec_pub as fecha_de_publicacion, autor from sjl_libros"));
        if($request->ajax()){
            return Response::json(array('data'=>$books));
        }
        else{
            return view('obras.create');
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
        $obra = new Obra();
        $obra->nom = $request->nom;
        $obra->resum = $request->resum;
        $obra->save();

        $obraL = new Obras_Libros();
        $obraL->id_obra = $obra->id;
        $obraL->id_lib = $request->libro;
        $obraL->save();

        return 1;
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
    public function edit($id, Request $request)
    {
        $books = DB::select(DB::raw("SELECT isbn, titulo_esp as titulo_en_español, titulo_ori as titulo_original, fec_pub as fecha_de_publicacion, autor from sjl_libros"));
        $obra = Obra::find($id);
        if($request->ajax()){
            return Response::json(array('data'=>$books, 'obra'=>$obra));
        }
        else{
            return view('obras.edit');
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
        $obra = Obra::find($id);
        $obra->nom = $request->nom;
        $obra->resum = $request->resum;
        $obra->save();

        $obraL = Obras_Libros::find($id);
        $obraL->id_obra = $obra->id;
        $obraL->id_lib = $request->libro;
        $obraL->save();

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obra = Obra::find($id);
        $obra->delete();
    }
}
