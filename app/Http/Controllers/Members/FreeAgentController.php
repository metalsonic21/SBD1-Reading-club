<?php

namespace App\Http\Controllers\Members;
use DB;
use Log;
use Response;
use App\Models\Member\Member;
use App\Models\Member\Membresia;
use App\Models\Member\Pago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreeAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()){
            $freeagents = DB::select(DB::raw("SELECT doc_iden as documento_de_identidad, nom1 as nombre, ape1 as apellido, fec_nac as fecha_de_nacimiento FROM sjl_lectores WHERE id_club IS NULL"));
            return Response::json(array('freeagents'=>$freeagents));
            }
            else{
                return view('members.freeagent');
        }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyDay(Request $request, $idclub, $idmember)
    {
        /* Si tratas de añadir un miembro que fue retirado del club el mismo día te dara un error */
        $today = date('Y-m-d');
        $checker = DB::select(DB::raw("SELECT * from sjl_membresias WHERE fec_i = '$today' AND id_lec = '$idmember' AND id_club = '$idclub'"));
        return $checker;
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
        Member::where('doc_iden',$request->selected)->update(array(
            'id_club'=> $id,
        ));

        $today = date('Y-m-d');

        $mship = new Membresia();
        $mship->fec_i = $today;
        $mship->id_club = $id;
        $mship->id_lec = $request->selected;
        $mship->estatus = 'A';
        $mship->save();

        $pago = new Pago();
        $pago->id_fec_mem = $mship->fec_i;
        $pago->id_club = $id;
        $pago->id_lec = $request->selected;
        $pago->fec_emi = $today;
        $pago->save();
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
