<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class GenerateReportsController extends Controller
{
    public function bookform(){
        return view ('reports.generate_reports.generate_book_report');
    }

    public function clubform(Request $request){
        if ($request->ajax()){
            $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nombre, c.fec_crea as fecha_de_creacion, (
                SELECT nom FROM sjl_idiomas WHERE id = c.id_idiom
            )idioma FROM sjl_clubes_lectura c"));
            return Response::json(array('data'=>$clubs));
        }
        else
            return view ('reports.generate_reports.generate_club_report');
    }

    public function attendanceform(Request $request){
        if ($request->ajax()){
            $clubs = DB::select(DB::raw("SELECT c.id, c.nom as nombre, c.fec_crea as fecha_de_creacion, (
                SELECT nom FROM sjl_idiomas WHERE id = c.id_idiom
            )idioma FROM sjl_clubes_lectura c"));
            return Response::json(array('data'=>$clubs));
        }
        else
            return view ('reports.generate_reports.generate_attendance_report');
    }
}
