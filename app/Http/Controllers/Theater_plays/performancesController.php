<?php

namespace App\Http\Controllers\theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Play;
use App\Models\Performance;
use Response;
class performancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $id_club= $req->id;
        $id_obra= $req->id_obra;
        $performances = DB::select( DB::raw("SELECT a.fec,a.id_obra,a.id_local,a.hora_i,a.durac,a.valor,a.num_asist,a.costo,a.id_club,b.nom as nombre_obra,c.nom as nombre_club,d.nom as nombre_lugar,d.cap,d.num_s,d.id_dir,d.tipo
        FROM SJL_historicos_presentaciones a, SJL_obras b, SJL_clubes_lectura c, SJL_locales_eventos d
        WHERE a.id_obra='$id_obra' AND a.id_obra=b.id AND a.id_club='$id_club'AND a.id_club=c.id AND a.id_obra=b.id AND a.id_local=d.id"));        
        return view('theater_plays.performances',compact('performances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        if($req->ajax()){
        $id_club=$req->id;
        $id_obra=$req->id_obra;
        $clubs=DB::select(DB::raw("SELECT id,nom FROM SJL_clubes_lectura WHERE id='$id_club'"));
        $obras=DB::select(DB::raw("SELECT id,nom FROM SJL_obras WHERE id='$id_obra'"));
        $obra=$obras[0];
        $club=$clubs[0];
        
            $ciudades = DB::select(DB::raw("SELECT a.id FROM sjl_clubes_lectura b, sjl_calles c, sjl_urbanizaciones d, sjl_ciudades a WHERE '$id_club'=b.id AND b.id_dir=c.id AND c.id_urb=d.id AND d.id_ciudad=a.id"));
            $ciudad = $ciudades[0]->id;
            $locales = DB::select(DB::raw("SELECT a.id as value,a.nom as text,b.nom as calle,c.nom as urb,d.nom as ciudad FROM SJL_locales_eventos a,sjl_calles b,SJL_urbanizaciones c,sjl_ciudades d WHERE a.id_dir=b.id AND b.id_urb=c.id AND c.id_ciudad=d.id AND'$ciudad'=d.id "));
            return Response::json(array('locales'=>$locales,'obra'=>$obra,'club'=>$club));
        }else return view('theater_plays.create_performance');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $durach = $request->durach;
        $duracm = $request->duracm;
        $duracion = "$durach:$duracm";
        $performance= new Performance();
        $performance->fec=$request->fec;
        $performance->id_obra=$request->id_obra;
        $performance->id_local=$request->id_local;
        $performance->hora_i=$request->hora_i;
        $performance->durac=$duracion;
        $performance->costo=$request->costo;
        $performance->id_club=$request->id_club;
        $performance->save();
        return $performance;
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'popo';
    }
    public function details($id)
    {
        return 'popo2';
    }
    public function mod($id)
    {
        return 'popo1';
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
    public function destroy($fec,$id_obra,$id_local,$id_club){
        DB::delete("DELETE FROM SJL_historicos_presentaciones WHERE id_club = '$id_club' AND fec = '$fec' AND id_obras = '$id_obra' AND id_local='$id_local'");
        return view('home');
    }
    
}
