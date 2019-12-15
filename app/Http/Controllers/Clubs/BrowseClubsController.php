<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use App\Models\Clubclub;
use App\Models\Language;
use App\Models\Street;
use App\Models\Urbanization;
use App\Models\Urbanizacion;
use App\Models\Calle;
use App\Models\City;
use App\Models\Country;
use App\Models\Institution;

class BrowseClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clubs = DB::select( DB::raw("SELECT id, nom, fec_crea, cuota, (
            SELECT nom as idioma from sjl_idiomas WHERE id = id_idiom
            ), (
            SELECT nom as calle from sjl_calles WHERE id = id_dir
            ), (
            SELECT nom as pais from sjl_paises WHERE id = (SELECT id_pais from sjl_ciudades WHERE id = (SELECT id_ciudad from sjl_urbanizaciones WHERE id = (SELECT id_urb from sjl_calles WHERE id = id_dir)))
            ) FROM sjl_clubes_lectura"));
        return view ('clubs.browse', compact('clubs'));
    }

    public function getid(Club $club)
    {
        Session::put('id', $club->id);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $languages = DB::table('sjl_idiomas')->select('id as value', 'nom as text')->get();
            $countries = DB::table('sjl_paises')->select('id as value','nom as text')->get();
            $cities = DB::select( DB::raw("SELECT id || '-' || id_pais as value, nom as text FROM sjl_ciudades"));
            $urbanizations = DB::table('sjl_urbanizaciones')->select('id as value','nom as text')->get();
            $aclubs = DB::table('sjl_clubes_lectura')->select('id as value','nom as text')->get();
           
            return Response::json(array('languages'=>$languages,'countries'=>$countries,'cities'=>$cities,'urbanizations'=>$urbanizations,'aclubs'=>$aclubs));
        }
        else{
            return view('clubs.create');
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
        $auxid = 0;
        $checker = DB::select(DB::raw("SELECT id FROM sjl_urbanizaciones WHERE nom = '$request->urb' AND id_ciudad = '$request->ciudad'"));
        
        if(!$checker){
            $count = DB::select(DB::raw("SELECT count(nom) as numero from sjl_urbanizaciones"));
            $c = $count[0]->numero;
            $urb = new Urbanizacion();
            $urb->id = $c+1;
            $urb->nom = $request->urb;
            $urb->id_ciudad = $request->ciudad;        
            $urb->save();
        }else{
            $auxid = $checker[0]->id;
        }

        //Log::info($urb);

        $checker2 = DB::select(DB::raw("SELECT id FROM sjl_calles WHERE nom = '$request->calle' AND id_urb = '$auxid'"));

        if(!$checker2){
            $street = new Calle();
            $countc = DB::select(DB::raw("SELECT count(nom) as numero from sjl_calles"));
            $cc = $countc[0]->numero;
            $street->id = $cc+1;
            $street->nom = $request->calle;
            $street->cod_post = $request->cod_post;
            if (!$checker)
                $street->id_urb = $urb->id;
            else
                $street->id_urb = $auxid;
            $street->save();
        }else{
            $auxid = $checker2[0]->id;
        }

        $inst = new Institution();
        if($request->nom_inst <> null && $request->tipo_inst <> null && $request->ciudad_inst <> null){
            $checker3 = DB::select(DB::raw("SELECT id FROM sjl_instituciones WHERE nom = '$request->nom_inst' AND id_ciudad = '$request->ciudad_inst'"));            
            if(!$checker3){
                $inst->nom = $request->nom_inst;
                $inst->tipo = $request->tipo_inst;
                $inst->id_ciudad = $request->ciudad_inst;       
                $inst->save();
            }else{
                $auxinst = $checker3[0]->id;
            }
        }else{
            $auxinst= null;
        }

        $club = new Club();
        $club->nom = $request->nom;
        $club->fec_crea = date("Y-m-d");
        $club->cuota = $request->cuota;
        if (!$checker2)
            $club->id_dir = $street->id;
        else
            $club->id_dir = $auxid;

        if($request->nom_inst <> null && $request->tipo_inst <> null && $request->ciudad_inst <> null && !$checker3)
            $club->id_inst = $inst->id;
        else
            $club->id_inst = $auxinst;
        $club->id_idiom = $request->id_idiom;
        $club->save();
        
        if(count($request->asociados) <> 1){
            for ($i = 1;$i < count($request->asociados);$i++){ 
                $clubclub = new Clubclub();
                $clubclub->id_club1 = $club->id;
                $clubclub->id_club2 = $request->asociados[$i];
                $clubclub->save();
            }
        }
        return $club;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club = Club::find($id);
        $idioma = DB::select(DB::raw("SELECT nom as idiom FROM sjl_idiomas WHERE id = '$club->id_idiom'"));
        $direccion = DB::select(DB::raw("SELECT p.nom as pais, ci.nom as ciudad, u.nom as urb, c.nom as calle, c.cod_post as codigo, p.moneda as moneda
                                            FROM  sjl_paises p, sjl_ciudades ci, sjl_urbanizaciones u, sjl_calles c
                                            WHERE c.id = '$club->id_dir' AND c.id_urb = u.id AND u.id_ciudad = ci.id AND ci.id_pais = p.id ")); 
        
        if($club->id_inst){
            $asoc = DB::select(DB::raw("SELECT p.nom as pais, ci.nom as ciudad, i.nom as inst, i.tipo as tipo
                                            FROM  sjl_paises p, sjl_ciudades ci, sjl_instituciones i
                                            WHERE i.id = '$club->id_inst' AND i.id_ciudad = ci.id AND ci.id_pais = p.id "));
        }else{
            $asoc[0] = (object)[
                'pais'=> null,
                'ciudad'=> null,
                'inst'=> null,
                'tipo'=> null,
            ];
        }

        $aclubs = DB::select(DB::raw("SELECT c.nom as nombre
                                        FROM sjl_clubes_lectura c, sjl_clubes_clubes cc
                                        WHERE (c.id = cc.id_club2 AND cc.id_club1 = '$club->id') OR (c.id = cc.id_club1 AND cc.id_club2 = '$club->id')              "));
        
        return view ('clubs.show')->with('club',$club)->with('idioma',$idioma)->with('direccion',$direccion)->with('asoc',$asoc)->with('aclubs',$aclubs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->ajax()){
            $club = Club::find($id);
            $direction = DB::select(DB::raw("SELECT p.id as pais, ci.id || '-' || ci.id_pais as ciudad, u.nom as urb, c.nom as calle, c.cod_post as codigo
                                                 FROM  sjl_paises p, sjl_ciudades ci, sjl_urbanizaciones u, sjl_calles c
                                                WHERE c.id = '$club->id_dir' AND c.id_urb = u.id AND u.id_ciudad = ci.id AND ci.id_pais = p.id ")); 

            $languages = DB::table('sjl_idiomas')->select('id as value', 'nom as text')->get();
            $countries = DB::table('sjl_paises')->select('id as value','nom as text')->get();
            $cities = DB::select( DB::raw("SELECT id || '-' || id_pais as value, nom as text FROM sjl_ciudades"));
            $urbanizations = DB::table('sjl_urbanizaciones')->select('id as value','nom as text')->get();
            $aclubs = DB::table('sjl_clubes_lectura')->select('id as value','nom as text')->get();

            $institution = DB::select(DB::raw("SELECT "));
            if($club->id_inst){
                $institution = DB::select(DB::raw("SELECT p.id as pais, ci.id || '-' || ci.id_pais as ciudad, i.nom as inst, i.tipo as tipo
                                                FROM  sjl_paises p, sjl_ciudades ci, sjl_instituciones i
                                                WHERE i.id = '$club->id_inst' AND i.id_ciudad = ci.id AND ci.id_pais = p.id "));
            }else{
                $institution[0] = null;
            }

            $aclubsid = DB::select(DB::raw("SELECT c.id as id_a
                                            FROM sjl_clubes_lectura c, sjl_clubes_clubes cc
                                            WHERE (c.id = cc.id_club2 AND cc.id_club1 = '$club->id') OR (c.id = cc.id_club1 AND cc.id_club2 = '$club->id') "));

            
            Log::info($aclubsid);
            return Response::json(array('club'=>$club,'languages'=>$languages,'countries'=>$countries,'cities'=>$cities,'urbanizations'=>$urbanizations,'aclubs'=>$aclubs,'direction'=>$direction[0],'institution'=>$institution[0],'aclubsid'=>$aclubsid));
        }
        else{
            return view('clubs.edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        Log::info("+---+Update+---+");
        Log::info($id);
        $club = Club::find($id);
        $auxid = 0;
        $checker = DB::select(DB::raw("SELECT id FROM sjl_urbanizaciones WHERE nom = '$request->urb' AND id_ciudad = '$request->ciudad'"));
        
        if(!$checker){
            $count = DB::select(DB::raw("SELECT count(nom) as numero from sjl_urbanizaciones"));
            $c = $count[0]->numero;
            $urb = new Urbanizacion();
            $urb->id = $c+1;
            $urb->nom = $request->urb;
            $urb->id_ciudad = $request->ciudad;        
            $urb->save();
        }else{
            $auxid = $checker[0]->id;
        }

        $checker2 = DB::select(DB::raw("SELECT id FROM sjl_calles WHERE nom = '$request->calle' AND id_urb = '$auxid'"));

        if(!$checker2){
            $street = new Calle();
            $countc = DB::select(DB::raw("SELECT count(nom) as numero from sjl_calles"));
            $cc = $countc[0]->numero;
            $street->id = $cc+1;
            $street->nom = $request->calle;
            $street->cod_post = $request->cod_post;
            if (!$checker)
                $street->id_urb = $urb->id;
            else
                $street->id_urb = $auxid;
            $street->save();
        }else{
            $auxid = $checker2[0]->id;
        }

        $inst = new Institution();
        if($request->nom_inst <> null && $request->tipo_inst <> null && $request->ciudad_inst <> null){
            $checker3 = DB::select(DB::raw("SELECT id FROM sjl_instituciones WHERE nom = '$request->nom_inst' AND id_ciudad = '$request->ciudad_inst'"));            
            if(!$checker3){
                $inst->nom = $request->nom_inst;
                $inst->tipo = $request->tipo_inst;
                $inst->id_ciudad = $request->ciudad_inst;       
                $inst->save();
            }else{
                $auxinst = $checker3[0]->id;
            }
        }else{
            $auxinst= null;
        }

        $club->nom = $request->nom;
        //$club->fec_crea = date("Y-m-d"); no se deberia modificar la fecha de creacion del club... creo
        $club->cuota = $request->cuota;
        if (!$checker2)
            $club->id_dir = $street->id;
        else
            $club->id_dir = $auxid;

        if($request->nom_inst <> null && $request->tipo_inst <> null && $request->ciudad_inst <> null && !$checker3)
            $club->id_inst = $inst->id;
        else
            $club->id_inst = $auxinst;
        $club->id_idiom = $request->id_idiom;
        $club->save();
        //Vacio los asociados antes de volver a llenarlo
        DB::delete(DB::raw("DELETE FROM sjl_clubes_clubes WHERE id_club1 = '$id' OR id_club2 = '$id' "));

        if(count($request->asociados) <> 1){
            for ($i = 1;$i < count($request->asociados);$i++){ 
                $clubclub = new Clubclub();
                $clubclub->id_club1 = $club->id;
                $clubclub->id_club2 = $request->asociados[$i];
                $clubclub->save();
            }
        }
        return $club;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $club = Club::find($id);
        $club->id_dir = -1;
        $club->id_inst = null;
        //Vacio los asociados
        DB::delete(DB::raw("DELETE FROM sjl_clubes_clubes WHERE id_club1 = '$id' OR id_club2 = '$id' "));
        Log:info($club);
        $club->delete();
        return redirect('browseclubs');
    }
}
