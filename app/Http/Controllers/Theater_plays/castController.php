<?php

namespace App\Http\Controllers\theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Play;
use App\Models\Performance;
use App\Models\Cast;
use App\Models\Cast_reader;
use Response;


class castController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $id_club = $req->id_club;
        $id_obra = $req->id_obra;
        $id_perform = $req->id_perform;
        $clubs=DB::select(DB::raw("SELECT id,nom FROM SJL_clubes_lectura WHERE id='$id_club'"));
        $obras=DB::select(DB::raw("SELECT id,nom FROM SJL_obras WHERE id='$id_obra'"));
        $obra=$obras[0];
        $club=$clubs[0];
        if($req->ajax()){
            $actores = DB::select(DB::raw("SELECT a.doc_iden,a.nom1,a.nom2,a.ape1,a.ape2 FROM SJL_lectores a"));
            return Response::json(array())
        }
       else return view('theater_plays.cast');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
