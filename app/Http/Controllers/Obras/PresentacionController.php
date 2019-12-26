<?php

namespace App\Http\Controllers\Obras;
use App\Models\Obra\Local;
use App\Models\Obra\Presentacion;
use App\Models\Obra\Obra;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idclub, Request $request)
    {
        $presentaciones = DB::select(DB::raw("SELECT p.fec, (
            SELECT o.nom FROM sjl_obras o WHERE p.id_obra = o.id
        )nombre, (
            SELECT l.nom FROM sjl_locales_eventos l WHERE l.id = p.id_local
        )lugar, (select to_char(p.hora_i::time, 'HH12:MI AM')) as hora_i, (select to_char(p.durac::time, 'HH12:MI')) as durac, p.valor, p.id_local as idlugar, p.id_obra as obra FROM sjl_historicos_presentaciones p WHERE id_club = '$idclub'"));
        if($request->ajax()){
            return Response::json(array('data'=>$presentaciones));
        }
        else{
            return view('obras.presentaciones');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyP($club, $fecha, $obra, $local, Request $request)
    {
        $checker = DB::select(DB::raw("SELECT * FROM sjl_historicos_presentaciones WHERE id_club = '$club' AND id_local = '$local' AND id_obra = '$obra' AND fec = '$fecha'"));
        return $checker;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idclub, Request $request)
    {
        $obras = DB::select(DB::raw("SELECT o.id, o.nom as nombre_de_obra, o.resum as resumen, (
            SELECT l.titulo_esp FROM sjl_libros l WHERE l.isbn = ol.id_lib AND o.id = ol.id_obra
        )libro FROM sjl_obras o, sjl_obras_libros ol WHERE o.id = ol.id_obra"));

        $locales = DB::select(DB::raw("SELECT id as value, nom as text FROM sjl_locales_eventos WHERE id_club = '$idclub'"));

        if($request->ajax()){
            return Response::json(array('data'=>$obras, 'locales'=>$locales));
        }
        else{
            return view('obras.crearpresentacion');
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
        $presentacion = new Presentacion();
        $presentacion->fec = $request->fecha;
        $presentacion->id_obra = $request->obra;
        $presentacion->id_local = $request->local;
        $presentacion->hora_i = $request->horai;
        $presentacion->valor = $request->valor;
        $presentacion->num_asist = $request->asist;
        $presentacion->costo = $request->costo;
        $presentacion->id_club = $request->club;
        $f = date('H:i', mktime($request->durac,$request->duracm));
        $presentacion->durac = $f;
        $presentacion->save();
        
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
    public function edit($club, Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mod($club, $fecha, $obra, $local, Request $request)
    {
        $obras = DB::select(DB::raw("SELECT o.id, o.nom as nombre_de_obra, o.resum as resumen, (
            SELECT l.titulo_esp FROM sjl_libros l WHERE l.isbn = ol.id_lib AND o.id = ol.id_obra
        )libro FROM sjl_obras o, sjl_obras_libros ol WHERE o.id = ol.id_obra"));

        $locales = DB::select(DB::raw("SELECT id as value, nom as text FROM sjl_locales_eventos WHERE id_club = '$club'"));

        $currentp = DB::select(DB::raw("SELECT fec as fecha, id_obra as obra, id_local as ubicacion, hora_i, (select to_char(durac::time, 'HH12:MI')) as durac, valor, num_asist, costo, id_club FROM sjl_historicos_presentaciones WHERE fec = '$fecha' AND id_club = '$club' AND id_obra = '$obra' AND id_local = '$local'"));
        $presentacion = $currentp[0];
        $checkerDurac = $currentp[0]->durac;
        $h = substr($checkerDurac, 0, stripos($checkerDurac, ':'));
        $m = substr($checkerDurac, stripos($checkerDurac, ':')+1, strlen($checkerDurac));


        if($request->ajax()){
            return Response::json(array('data'=>$obras, 'locales'=>$locales, 'presentacion'=>$presentacion, 'hours'=>$h, 'minutes'=>$m));
        }
        else{
            return view('obras.editpresentacion');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modificar(Request $request, $club, $fecha, $obra, $local)
    {
        $currentpres = DB::select(DB::raw("SELECT fec, id_club, id_obra, id_local FROM sjl_historicos_presentaciones WHERE fec='$fecha' AND id_club = '$club' AND id_obra = '$obra' AND id_local = '$local'"));
        $presentacion = $currentpres[0];
        $presentacion->fec = $request->fecha;
        $f = date('H:i', mktime($request->durac,$request->duracm));

        if ($presentacion->fec == $request->prevdate && $request->prevlocal == $request->local && $request->prevobras == $request->obra){
            Presentacion::where(['id_obra'=>$request->prevobras,'id_local'=>$request->prevlocal,'fec'=>$request->prevdate])->update(array(
                    'hora_i'=>$request->horai,
                    'durac'=>$f,
                    'valor'=>$request->valor,
                    'num_asist'=>$request->asist,
                    'costo'=>$request->costo,
                    'id_club'=>$club
                ));    
        }
        else{
            Presentacion::where(['id_obra'=>$request->prevobras,'id_local'=>$request->prevlocal,'fec'=>$request->prevdate])->update(array(
                'hora_i'=>$request->horai,
                'durac'=>$f,
                'id_obra'=>$request->obra,
                'id_local'=>$request->local,
                'fec'=>$request->fecha,
                'valor'=>$request->valor,
                'num_asist'=>$request->asist,
                'costo'=>$request->costo,
                'id_club'=>$club
            ));    
        }

        return 1;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($club, $fecha, $obra, $local)
    {
        DB::delete("DELETE FROM sjl_historicos_presentaciones WHERE id_club = '$club' AND fec = '$fecha' AND id_obra = '$obra' AND id_local = '$local'");
        return 1;
    }
}
