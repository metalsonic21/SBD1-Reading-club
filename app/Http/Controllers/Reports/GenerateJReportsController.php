<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class GenerateJReportsController extends Controller
{
    public function chronlogyform(Request $request){
        if ($request->ajax()){
            $members = DB::select(DB::raw("SELECT doc_iden as doc_identidad,
            nom1 || ' ' || (CASE WHEN nom2 IS NOT NULL THEN nom2 || ' ' ELSE '' END) || ape1 || ' ' || ape2 as miembro,
            fec_nac as fecha_de_nacimiento FROM SJL_lectores ORDER BY doc_identidad;"));
            return Response::json(array('data'=>$members));
        }
        else
            return view ('reports.generate_reports.generate_chronology_report');
    }

    public function meetingform(Request $request){
        if ($request->ajax()){
            $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nombre, c.fec_crea as fecha_de_creacion, (
                SELECT nom FROM sjl_idiomas WHERE id = c.id_idiom
            )idioma FROM sjl_clubes_lectura c"));
            return Response::json(array('data'=>$clubs));
        }
        else
            return view ('reports.generate_reports.generate_meeting_report');
    }

    public function presentationform(Request $request){
        if ($request->ajax()){
            $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nombre, c.fec_crea as fecha_de_creacion, (
                SELECT nom FROM sjl_idiomas WHERE id = c.id_idiom
            )idioma FROM sjl_clubes_lectura c"));
            return Response::json(array('data'=>$clubs));
        }
        else
            return view ('reports.generate_reports.generate_presentation_report');
    }
}
