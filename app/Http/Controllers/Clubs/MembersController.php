<?php

namespace App\Http\Controllers\Clubs;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Telefono;
use App\Models\Calle;
use App\Models\Urbanizacion;
use App\Models\Representante;
use App\Models\Membresia;
use App\Models\Pago;
use Response;
use DB;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $members = DB::select(DB::raw("SELECT doc_iden, nom1 as nom, ape1 as ape, fec_nac FROM sjl_lectores WHERE id_club = '$id'"));
        return view('clubs.managemembers')->with('members', $members)->with('club', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if ($request->ajax()){
        $countries = DB::select(DB::raw("SELECT id as value, nom as text from sjl_paises"));
        $cities = DB::select( DB::raw("SELECT id || '-' || id_pais as value, nom as text FROM sjl_ciudades"));
        return Response::json(array('countries'=>$countries,'cities'=>$cities));
        }
        else{
            return view('clubs.createmember');
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
        /* Searches for urb with the same name and city if it doesn't exist it will insert it, same with the street*/
        $q = NULL;
        $q2 = NULL;
        $test = DB::select(DB::raw("SELECT id from sjl_urbanizaciones WHERE nom = '$request->urbanizacion' AND id_ciudad = '$request->ciudad'"));
            if (!$test){
                $urbanizacion = new Urbanizacion();
                $urbanizacion->nom = $request->urbanizacion;
                $urbanizacion->id_ciudad = $request->ciudad;
                $urbanizacion->save();
            }
        $aux = 0;

        if ($test)
        $aux = $test[0]->id;
        $testcalle = DB::select(DB::raw("SELECT id from sjl_calles WHERE nom = '$request->calle' AND id_urb = '$aux'"));

            if (!$testcalle){
                $calle = new Calle();
                $calle->nom = $request->calle;
                $calle->cod_post = $request->zipcode;
                    if (!$test)
                        $calle->id_urb = $urbanizacion->id;
                    else
                        $calle->id_urb = $aux;
                $calle->save();
            }

        /* REP ADDRESS */
        if ($request->docidenR){
        $testR = DB::select(DB::raw("SELECT id from sjl_urbanizaciones WHERE nom = '$request->urbanizacionR' AND id_ciudad = '$request->ciudadR'"));
            if (!$testR){
                $urbanizacionR = new Urbanizacion();
                $urbanizacionR->nom = $request->urbanizacionR;
                $urbanizacionR->id_ciudad = $request->ciudadR;
                $urbanizacionR->save();
            }
        $auxR = 0;

        if ($testR)
        $auxR = $testR[0]->id;

        $testcalleR = DB::select(DB::raw("SELECT id from sjl_calles WHERE nom = '$request->calleR' AND id_urb = '$auxR'"));

            if (!$testcalleR){
                $calleR = new Calle();
                $calleR->nom = $request->calleR;
                $calleR->cod_post = $request->zipcodeR;
                    if (!$testR)
                        $calleR->id_urb = $urbanizacionR->id;
                    else
                        $calleR->id_urb = $auxR;
                    $calleR->save();
            }


        /* REP */
            $q = DB::select(DB::raw("SELECT doc_iden from sjl_representantes WHERE doc_iden = '$request->docidenR'"));
            $q2 = DB::select(DB::raw("SELECT doc_iden from sjl_lectores WHERE doc_iden = '$request->docidenR'"));
            if (!$q && !$q2){
                $representante = new Representante();
                $representante->doc_iden = $request->docidenR;
                $representante->nom1 = $request->nom1R;
                $representante->nom2 = $request->nom2R;
                $representante->ape1 = $request->ape1R;
                $representante->ape2 = $request->ape2R;
                $representante->fec_nac = $request->fec_nacR;

                    if (!$testcalleR)
                        $representante->id_dir = $calleR->id;
                    else
                        $representante->id_dir = $testcalleR[0]->id;
                $representante->save();
            }
        }
            /* LECTOR */
            $member = new Member();
            $member->doc_iden = $request->dociden;
            $member->nom1 = $request->nom1;
            $member->nom2 = $request->nom2;
            $member->ape1 = $request->ape1;
            $member->ape2 = $request->ape2;
            $member->genero = $request->genero;
            $member->fec_nac = $request->fec_nac;
            $member->id_nac = $request->pais;
            $member->id_club = $request->club;

                if (!$testcalle)
                    $member->id_calle = $calle->id;
                else
                    $member->id_calle = $testcalle[0]->id;

                /* Deciding if I'm going to fill id_rep or id_rep_lect */

                if (!$q && !$q2){
                    $member->id_rep = $request->docidenR;
                }

                else if ($q && !$q2){
                    $member->id_rep = $request->docidenR;
                }

                else if (!$q && $q2){
                    $member->id_rep_lec = $request->docidenR;
                }
                
            DB::insert('INSERT INTO sjl_lectores (doc_iden, nom1, nom2, ape1, ape2, genero, fec_nac, 
            id_club, id_calle, id_rep, id_rep_lec, id_nac) values 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$member->doc_iden, 
            $member->nom1, $member->nom2, $member->ape1, $member->ape2, $member->genero, 
            $member->fec_nac, $member->id_club, $member->id_calle, $member->id_rep, $member->id_rep_lec, 
            $member->id_nac]);

            /* PHONE */

            $telefono = new Telefono();
            $telefono->cod_pais = $request->codp;
            $telefono->cod_area = $request->coda;
            $telefono->num = $request->telefono;
            $telefono->id_lector = $member->doc_iden;
            $telefono->save();

            /* MEMBERSHIP */

            $mship = new Membresia();
            $mship->fec_i = $request->today;
            $mship->id_club = $request->club;
            $mship->id_lec = $request->dociden;
            $mship->estatus = 'A';
            $mship->save();

            /* Registrar primer pago */

            $pago = new Pago();
            $pago->id_fec_mem = $mship->fec_i;
            $pago->id_club = $request->club;
            $pago->id_lec = $request->dociden;
            $pago->fec_emi = $request->today;
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
    public function edit($id)
    {
        return view ('clubs.editmember');
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
    public function destroy($idclub , $dociden)
    {
        //
    }
}
