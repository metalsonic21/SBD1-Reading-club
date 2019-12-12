<?php

namespace App\Http\Controllers\Theater_plays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Play;
//use App\Models\Play;
class CastPlaysController extends Controller
{
    public function index(Request $request){
        $plays = DB::select( DB::raw("SELECT id,nom,resum,costo,to_char(durac,'HH:MI:SS') duracion,estatus,id_local FROM sjl_obras"));
        return view('theater_plays.castplays',compact('plays'));
    }
    public function create() {
        return view('theater_plays.create');
    }
    public function add() {
        return view('theater_plays.character_add');
    }
    public function obrasclub($id){
        $plays = DB::select( DB::raw("SELECT id,nom,resum,costo,to_char(durac,'HH:MI:SS') duracion,estatus,id_local FROM sjl_obras WHERE (SELECT id_club FROM SJL_historicos_presentaciones)=$id"));
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
