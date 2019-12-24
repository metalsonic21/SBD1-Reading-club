<?php

namespace App\Http\Controllers\Members;
use App\Models\Member\Pago;
use App\Models\Member\Member;
use App\Models\Member\Membresia;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($club, $member, Request $request)
    {  
        /* If club is associated with an institution you shouldn't be able to see any payments/create/edit */
        $kind = DB::select(DB::raw("SELECT id_inst FROM sjl_clubes_lectura WHERE id = '$club'"));
        $canAdd = $kind[0]->id_inst;

        if ($canAdd == null) {
            if ($request->ajax()){
                $memberinfo = Member::find($member);
                $pagos = DB::select(DB::raw("SELECT id as id, id_fec_mem as fechamembresia, fec_emi as fechapago FROM sjl_historicos_pagos_memb WHERE id_lec = '$member'"));
                return Response::json(array('club'=>$club,'member'=>$memberinfo,'pagos'=>$pagos));
            }
            else return view ('members.managepayments');
        }
        else {
            return view ('error.402');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($club, $member, Request $request)
    {
    /* If club is associated with an institution you shouldn't be able to see any payments/create/edit */
        $kind = DB::select(DB::raw("SELECT id_inst FROM sjl_clubes_lectura WHERE id = '$club'"));
        $canAdd = $kind[0]->id_inst;
            if ($canAdd == null) {
                if ($request->ajax()){
                    $memberinfo = Member::find($member);
                    return Response::json(array('data'=>$memberinfo));
                }
                
                else return view('members.createpayment');
            }
            else {
                return view ('error.402');
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
        $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$request->member'"));
        $pago = new Pago();
        $pago->id_fec_mem = $membresia[0]->fec_i;
        $pago->id_club = $request->club;
        $pago->id_lec = $request->member;
        $pago->fec_emi = $request->date;
        $pago->save();
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
    public function edit($club, $member, $codpay, Request $request)
    {
        if ($request->ajax()){
            $memberinfo = Member::find($member);
            $payinfo = DB::select(DB::raw("SELECT fec_emi FROM sjl_historicos_pagos_memb WHERE id = '$codpay' AND id_club = '$club' AND id_lec = '$member'"));
            $pi = $payinfo[0]->fec_emi;
            return Response::json(array('data'=>$memberinfo,'pago'=>$pi));
        }
        else{
            return view('members.editpayment');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $membresia = DB::select(DB::raw("SELECT fec_i FROM sjl_membresias WHERE fec_f IS NULL AND id_lec = '$request->member'"));
        Pago::where(['id_fec_mem'=>$membresia[0]->fec_i,'id_club'=>$request->club,'id_lec'=>$request->member,'fec_emi'=>$request->prevdate])->update(array(
            'fec_emi'=> $request->date,
        ));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idclub, $idmember, $idpay)
    {
        $pago = Pago::find($idpay);
        $pago->delete();
        return 1;
    }
}
