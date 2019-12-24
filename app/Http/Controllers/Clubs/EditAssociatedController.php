<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Club\Club;
use App\Models\Club\Clubclub;
use App\Models\Language;
use App\Models\Street;
use App\Models\Urbanization;
use App\Models\Lugar\City;
use App\Models\Lugar\Country;
use App\Models\Institution;

class EditAssociatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    public function edit(Request $request, $id)
    {
        if($request->ajax()){
            $club = Club::find($id);
            $language = DB::select(DB::raw(" SELECT nom FROM sjl_idiomas WHERE id = '$club->id_idiom' "));

            $aclubs = DB::table('sjl_clubes_lectura')->select('id as value','nom as text','id_idiom as idiom')->get();

            $aclubsid = DB::select(DB::raw("SELECT c.id as id_a
                                            FROM sjl_clubes_lectura c, sjl_clubes_clubes cc
                                            WHERE (c.id = cc.id_club2 AND cc.id_club1 = '$club->id') OR (c.id = cc.id_club1 AND cc.id_club2 = '$club->id') "));

            
            Log::info($aclubs);
            return Response::json(array('club'=>$club,'language'=>$language[0],'aclubs'=>$aclubs,'aclubsid'=>$aclubsid));
        }
        else{
            return view('clubs.editassociated');
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
        Log::info($id);
        $club = Club::find($id);
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
        //
    }

}
