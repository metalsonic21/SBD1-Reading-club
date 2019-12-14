<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Play;


class playsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plays = DB::select( DB::raw("SELECT id,nom,resum FROM sjl_obras"));
        return view('theater_plays.castplays',compact('plays'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getid(Play $play)
    {
        Session::put('id', $play->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){        
            $libros = DB::select( DB::raw("SELECT isbn as value,titulo_esp as text FROM sjl_libros"));
            return Response::json(array('libros'=>$libros));
        }else return view('theater_plays.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $play = new Play();
        $play->nom = $request->nom;
        $play->resum = $request->resum;
        $play->save();
        return $play;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, Play $play)
        {
        if($request->ajax()){
            $libros = DB::select( DB::raw("SELECT isbn as value,titulo_esp as text FROM sjl_libros"));
            return Response::json(array('libros'=>$libros));
        }
        else{
            return view('castplays.edit',compact($play));
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
        $edit = DB::select( DB::raw("SELECT nom FROM sjl_editoriales WHERE id = '$book->id_edit'"))[0];
        $prev = Book::find($book->id_prev);
        return view('Teather_plays.show')->with('edit', $edit)->with('book', $book)->with('prev', $prev)->with('structure', $structure);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $test=Play::find($id);
        $test->delete();
        return redirect('castplays');
    }
}
