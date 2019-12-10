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

            /*Si agrego un lector que ya estaba en la tabla representantes actualizo todos los id de representantes y luego lo elimino de la tabla*/
            $testmem = DB::select(DB::raw("SELECT doc_iden FROM sjl_representantes WHERE doc_iden = '$request->dociden'"));
            DB::insert('INSERT INTO sjl_lectores (doc_iden, nom1, nom2, ape1, ape2, genero, fec_nac, 
            id_club, id_calle, id_rep, id_rep_lec, id_nac) values 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$member->doc_iden, 
            $member->nom1, $member->nom2, $member->ape1, $member->ape2, $member->genero, 
            $member->fec_nac, $member->id_club, $member->id_calle, $member->id_rep, $member->id_rep_lec, 
            $member->id_nac]);

                if ($testmem){
                    Member::where('id_rep',$request->dociden)->update(array(
                        'id_rep'=>NULL,
                        'id_rep_lec'=>$request->dociden,
                    ));

                DB::table('sjl_representantes')
                    ->where('doc_iden',$request->dociden)
                    ->delete();
                }


                
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

            return $testmem;
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
    public function edit($club, $id, Request $request)
    {
        if($request->ajax()){
            $member = new Member();
            $member = DB::select(DB::raw("SELECT doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_calle, id_rep, id_rep_lec, id_nac FROM sjl_lectores WHERE doc_iden = '$id'"));
            $member = $member[0];
            $paises = DB::select(DB::raw("SELECT id as value, nom as text FROM sjl_paises"));
            $ciudades = DB::select( DB::raw("SELECT id || '-' || id_pais as value, nom as text FROM sjl_ciudades"));
 
            $currentCM = DB::select(DB::raw("SELECT e.nom as text, e.id || '-' || e.id_pais as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e WHERE ca.id = '$member->id_calle' AND ca.id_urb = u.id AND u.id_ciudad = e.id"));
            $currentCM = $currentCM[0]->value;

            $currentUM = DB::select(DB::raw("SELECT u.nom as nombre from sjl_calles ca, sjl_urbanizaciones u WHERE ca.id = '$member->id_calle' AND ca.id_urb = u.id"));
            $currentUM = $currentUM[0]->nombre;
            
            $currentSM = DB::select(DB::raw("SELECT ca.nom as nombre from sjl_calles ca WHERE ca.id = '$member->id_calle'"));
            $currentSM = $currentSM[0]->nombre;


            $currentZM = DB::select(DB::raw("SELECT cod_post as code from sjl_calles WHERE id = '$member->id_calle'"));
            $currentZM = $currentZM[0]->code;
            
            $currentTEL = DB::select(DB::raw("SELECT cod_pais, cod_area, num, id_lector FROM sjl_telefonos WHERE id_lector = '$id'"));
            $currentTEL = $currentTEL[0];

            /* REPRESENTANTE: Search if it is on rep or member table*/
            $representante = '';
            $currentCR = '';
            $currentPR = '';
            $currentUR = '';
            $currentZR = '';

            if ($member->id_rep != NULL){
                $representante = new Representante();
                $representante = DB::select(DB::raw("SELECT doc_iden, nom1, nom2, ape1, ape2, fec_nac, id_dir FROM sjl_representantes WHERE doc_iden = '$member->id_rep'"));
                $representante = $representante[0];
                $currentPR = DB::select(DB::raw("SELECT p.nom as text, p.id as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id"));
                $currentPR = $currentPR[0]->value;

                $currentCR = DB::select(DB::raw("SELECT e.nom as text, e.id || '-' || e.id_pais as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id AND u.id_ciudad = e.id"));
                $currentCR = $currentCR[0]->value;

                $currentUR = DB::select(DB::raw("SELECT u.nom from sjl_calles ca, sjl_urbanizaciones u WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id"));
                $currentUR = $currentUR[0]->nom;
                $currentSR = DB::select(DB::raw("SELECT ca.nom from sjl_calles ca WHERE ca.id = '$representante->id_dir'"));
                $currentSR = $currentSR[0]->nom;
                
                $currentZR = DB::select(DB::raw("SELECT cod_post as code from sjl_calles WHERE id = '$representante->id_dir'"));
                $currentZR = $currentZR[0]->code;    
            }

            else if ($member->id_rep_lec != NULL) {
                $representante = new Member();
                $representante = DB::select(DB::raw("SELECT doc_iden, nom1, nom2, ape1, ape2, fec_nac, id_calle FROM sjl_lectores WHERE doc_iden = '$member->id_rep_lec'"));
                $representante = $representante[0];
                $currentPR = DB::select(DB::raw("SELECT p.nom as text, p.id as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = '$representante->id_calle' AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id"));
                $currentPR = $currentPR[0]->value;

                $currentCR = DB::select(DB::raw("SELECT e.nom as text, e.id || '-' || e.id_pais as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e WHERE ca.id = '$representante->id_calle' AND ca.id_urb = u.id AND u.id_ciudad = e.id"));
                $currentCR = $currentCR[0]->value;

                $currentUR = DB::select(DB::raw("SELECT u.nom from sjl_calles ca, sjl_urbanizaciones u WHERE ca.id = '$representante->id_calle' AND ca.id_urb = u.id"));
                $currentUR = $currentUR[0]->nom;

                $currentSR = DB::select(DB::raw("SELECT ca.nom from sjl_calles ca WHERE ca.id = '$representante->id_calle'"));
                $currentSR = $currentSR[0]->nom;

                $currentZR = DB::select(DB::raw("SELECT cod_post as code from sjl_calles WHERE id = '$representante->id_calle'"));
                $currentZR = $currentZR[0]->code;    

            }
            return Response::json(array('data'=>$member,'paises'=>$paises,'ciudades'=>$ciudades, 'currentCM'=>$currentCM, 
            'currentUM'=>$currentUM, 'currentSM'=>$currentSM,'currentZM'=>$currentZM, 'representante'=>$representante, 'currentCR'=>$currentCR,
            'currentUR'=>$currentUR, 'currentSR'=>$currentSR, 'currentZR'=>$currentZR,'currentTEL'=>$currentTEL,'currentPR'=>$currentPR));
        }
        else{
            return view('clubs.editmember');
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

            /*Si agrego un lector que ya estaba en la tabla representantes actualizo todos los id de representantes y luego lo elimino de la tabla*/
            $testmem = DB::select(DB::raw("SELECT doc_iden FROM sjl_representantes WHERE doc_iden = '$request->dociden'"));
            $member->save();

                if ($testmem){
                    Member::where('id_rep',$request->dociden)->update(array(
                        'id_rep'=>NULL,
                        'id_rep_lec'=>$request->dociden,
                    ));

                DB::table('sjl_representantes')
                    ->where('doc_iden',$request->dociden)
                    ->delete();
                }


                
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

            return $testmem;
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
