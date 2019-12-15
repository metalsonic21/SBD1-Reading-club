<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Play;
use App\Models\Play_book;
use App\Models\Book;


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
        $play_book = new Play_book();
        $play_book->id_lib = $request->ObraBase;
        $play_book->id_obra= $play->id;
        DB::insert('INSERT INTO sjl_obras_libros(id_obra,id_lib)values (?, ?)',[$play_book->id_obra,$play_book->id_lib]);
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

    public function edit($id,Request $request)
        {
        if($request->ajax()){
            $play= DB::select(DB::raw("SELECT id,nom,resum from sjl_obras where id='$id' "));
            $libros = DB::select( DB::raw("SELECT isbn as value,titulo_esp as text FROM sjl_libros"));
            $obrabase= DB::select(DB::raw("SELECT a.id_lib as value,b.titulo_esp as text FROM SJL_obras_libros a,SJL_libros b WHERE (b.isbn=a.id_lib) AND (a.id_obra='$id')"));
            $ob = $obrabase[0]->value;
            $ob1 = $obrabase[0]->text;
            return Response::json(array('libros'=>$libros,'play'=>$play,'value'=>$ob,'text'=>$ob1));
        }
        else{
            return view('theater_plays.edit');
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
        $play=new Play();
        $play->id=$request->id;
        $play->nom=$request->nom;
        $play->resum=$request->resum;
        Play::where('id',$play->id)->update(
            array(
                'id'=> $play->id,
                'nom'=> $play->nom,
                'resum'=> $play->resum
            ));
        $plays = DB::select( DB::raw("SELECT id,nom,resum FROM sjl_obras"));
        return view('theater_plays.castplays',compact('plays'));        
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test=Play::find($id);
        $test->delete();
        return redirect('castplays');
    }
}
