<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Redirect;
use PDF;
use Response;
use App\Models\Member\Member;
use App\Models\Member\Telefono;
use App\Models\Lugar\Calle;
use App\Models\Lugar\Urbanizacion;
use App\Models\Member\Representante;
use App\Models\Member\Membresia;
use App\Models\Member\Pago;
use App\Models\Club\Club;
use Log;
class ReportsLCIController extends Controller
{
    public function bookspdf($isbn){
      
        $check_book = DB::select(DB::raw("SELECT l.titulo_esp, l.isbn, l.titulo_ori, l.tema_princ, l.sinop
        , l.n_pag, l.fec_pub, l.autor, 
            (SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NULL AND 
        g.id_lib = l.isbn)genero, (
            SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NOT NULL AND 
        g.id_lib = l.isbn
        )subgenero
            FROM sjl_libros l
            WHERE l.isbn = '$isbn'
            ORDER BY l.isbn;"));

        $book = $check_book[0];

        $structures = DB::select(DB::raw("SELECT (CASE WHEN e.tipo = 'C' THEN 'Capítulo' ELSE '' END) || ' ' || s.num || ' — ' || s.nom as fullnom, e.id_lib as lib
        FROM sjl_secciones_libros s, sjl_estructuras_libros e 
        WHERE e.id = s.id_est AND e.id_lib = '$isbn' AND s.id_lib = '$isbn'
        ORDER BY e.id_lib, s.num; "));
        $data = [
            'book'     => $book,
            'structs' => $structures,
        ];
        $pdf = PDF::loadView('reports.base', $data);
        return $pdf->download('books.pdf');
    }

    public function books (Request $request){
        return $this->bookspdf($request->libro);
    }
    
    public function clubspdf ($id){
        $club_check = DB::select(DB::raw("SELECT c.id, c.nom as nom FROM sjl_clubes_lectura c
            WHERE c.id = '$id'
            ORDER BY c.nom"));

        $club = $club_check[0];

        $grupos = DB::select(DB::raw("SELECT g.nom, g.id as id, g.id_club as club, (CASE
        WHEN g.dia_sem = 2 THEN 'Lunes'
        WHEN g.dia_sem = 3 THEN 'Martes'
        WHEN g.dia_sem = 4 THEN 'Miercoles'
        WHEN g.dia_sem = 5 THEN 'Jueves'
        ELSE 'Viernes'
    END)dia, (select to_char(g.hora_i::time, 'HH12:MI AM')) || ' - ' || (select to_char(g.hora_f::time, 'HH12:MI AM')) as horario,
    (CASE
        WHEN g.tipo = 'A' THEN 'Adultos'
        WHEN g.tipo = 'J' THEN 'Jovenes'
        ELSE 'Niños'
    END)tipo
    FROM sjl_grupos_lectura g
    WHERE g.id_club = '$id'
    ORDER BY g.nom;"));

    $associated = DB::select(DB::raw("SELECT a.id_club1 as idone, a.id_club2 as idtwo, (SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club1)clubone, (
            SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club2
        )clubtwo FROM sjl_clubes_clubes a
        WHERE a.id_club1 = '$id'"));


        $data = [
            'club'     => $club,
            'grupos' => $grupos,
            'associated' => $associated,
        ];
        $pdf = PDF::loadView('reports.club_info', $data);
        return $pdf->download('clubs.pdf');
    }

    public function clubs (Request $request){
        return $this->clubspdf($request->club);
    }

    public function CatchThirtythree($club){
        $club_check = DB::select(DB::raw("SELECT c.id, c.nom as nom FROM sjl_clubes_lectura c 
        WHERE c.id='$club'"));
        $club = $club_check[0];

        $na = DB::select(DB::raw("SELECT (
            SELECT nom1 || ' ' || ape1 from sjl_lectores WHERE doc_iden = m.id_lec
        )victim, 
        (
            SELECT doc_iden from sjl_lectores WHERE doc_iden = m.id_lec
        )victimid,
        m.id_club 
            FROM sjl_membresias m WHERE m.fec_f IS NOT NULL AND m.motivo_b = 'I' AND m.id_club = '$club->id'"));

        $data = [
            'club'     => $club,
            'na' => $na,
        ];
        $pdf = PDF::loadView('reports.30', $data);
        return $pdf->download('30.pdf');
    }

    public function attendances(Request $request){
        return $this->CatchThirtythree($request->club);
    }

    public function cronoMembers(){
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom, c.fec_crea,
        (SELECT count (*) FROM sjl_membresias WHERE c.id = id_club) as n_miembros
        FROM sjl_clubes_lectura c ORDER BY fec_crea;"));

        $members = DB::select(DB::raw("SELECT m.fec_i, m.id_lec, m.id_club,
        (SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE m.id_lec = doc_iden ) as fullnom,
        (SELECT count (*) FROM sjl_reuniones_mensuales WHERE m.id_lec = id_lec AND m.id_club = id_club AND n_ses = 1) as n_libros      
        FROM sjl_membresias m
        ORDER BY m.fec_i;"));

        $books = DB::select(DB::raw("SELECT l.isbn, l.titulo_ori, r.id_club,r.id_lec FROM sjl_libros l, sjl_reuniones_mensuales r WHERE r.id_lib = l.isbn AND r.n_ses = 1 "));

        $data = [
            'clubs' => $clubs,
            'members' => $members,
            'books' => $books,
        ];
        $pdf = PDF::loadView('reports.crono_members', $data);
        return $pdf->download('Ficha_cronologica_club.pdf');
    }

    public function meetings(){
        
        $clubs = DB::select(DB::raw("SELECT c.id, c.nom, c.fec_crea FROM sjl_clubes_lectura c;"));

        $groups = DB::select(DB::raw("SELECT g.id,g.id_club,g.nom,
            (SELECT count (*) FROM sjl_reuniones_mensuales WHERE g.id = id_grupo ) as n_reu
            FROM sjl_grupos_lectura g;"));

        $meetings = DB::select(DB::raw("SELECT r.fec,r.id_grupo,r.n_ses,r.conclu,r.valor,(
            SELECT titulo_ori FROM sjl_libros WHERE r.id_lib = isbn),(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE r.id_lec = doc_iden
            ) as moder
            FROM sjl_reuniones_mensuales r ORDER BY r.fec;"));

        $members = DB::select(DB::raw("SELECT r.fec, r.id_grupo,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE gl.id_lec = doc_iden
            ) as fullnom, (CASE WHEN EXISTS(SELECT fec_reu_men from sjl_inansistencias WHERE fec_reu_men = r.fec AND id_lec = gl.id_lec) THEN 'I' ELSE 'A' END) as asistencia
            FROM sjl_reuniones_mensuales r , sjl_grupos_lectores gl
            WHERE r.fec > gl.id_fec_i and r.id_grupo = gl.id_grupo and (CASE WHEN gl.fec_f IS NOT NULL THEN r.fec < gl.fec_f ELSE TRUE END)
            ORDER BY fullnom;"));

        $data = [
            'clubs' => $clubs,
            'groups' => $groups,
            'meetings' => $meetings,
            'members' => $members,
        ];
        $pdf = PDF::loadView('reports.meetings', $data);
        return $pdf->download('Ficha_reuniones.pdf');
    }

    public function presentations(){

        $clubs = DB::select(DB::raw("SELECT c.id, c.nom,(SELECT count (*) FROM sjl_historicos_presentaciones WHERE id_club = c.id) as n_pres
            FROM sjl_clubes_lectura c;")); 

        $presentations = DB::select(DB::raw("SELECT p.fec,p.hora_i,p.durac,p.id_club,p.valor,p.id_obra,(
            SELECT nom FROM sjl_obras WHERE id = p.id_obra) as obra,(
            SELECT nom FROM sjl_locales_eventos WHERE id = p.id_local) as lcl,(
            SELECT count (*) FROM sjl_elenco_lectores e WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE ) as n_act
            FROM sjl_historicos_presentaciones p;"));

        $actors = DB::select(DB::raw("SELECT p.fec, p.id_obra, p.id_club,(
            SELECT nom FROM sjl_personajes WHERE id = e.id_pers) AS pers,(
            SELECT l.nom1 || ' ' || (CASE WHEN l.nom2 IS NOT NULL THEN l.nom2 || ' '  ELSE '' END) || l.ape1 || ' ' || l.ape2 FROM sjl_lectores l WHERE e.id_lec = doc_iden) as fullnom
            FROM sjl_elenco_lectores e, sjl_historicos_presentaciones p
            WHERE e.id_hist_pre = p.fec AND e.id_obra = p.id_obra AND e.id_club = p.id_club AND e.mej_act = TRUE;"));

        $data = [
            'clubs' => $clubs,
            'presentations' => $presentations,
            'actors' => $actors,
        ];
        $pdf = PDF::loadView('reports.presentations',$data);
        return $pdf->download('Presentaciones.pdf');
    }
    public function book_analyzed ($id,$fechai,$fechaf){
        $clubs = DB::select(DB::raw("SELECT c.id,c.nom FROM SJL_clubes_lectura"));
        foreach($club as $clubs){
            $club->books=DB::select(DB::raw("SELECT l.isbn,l.titulo_esp,(SELECT(AVG(h.valor)) FROM SJL_reuniones_mensuales h,SJL_Libros j,SJL_grupos_lectura k,SJL_clubes_lectura o
            WHERE h.valor is not null AND l.isbn=h.id_lib AND h.id_grupo=k.id AND k.id_club=o.id AND o.id='$club->id' AND (h.fec BETWEEN '$fechai' AND '$fechaf'))
              FROM SJL_reuniones_mensuales a,SJL_Libros l,SJL_grupos_lectura b,SJL_clubes_lectura c Where l.isbn=a.id_lib and a.id_grupo=b.id and a.valor is not null and a.id_grupo=b.id and b.id_club=c.id AND c.id='$club->id' ORDER BY l.isbn"));
        }
    }

    public function club_member(){
        $members = DB::select(DB::raw("SELECT doc_iden,nom1,nom2,ape1,id_club as club_act,id_grup as grup_act,id_rep,id_rep_lec FROM SJL_Lectores"));
        foreach($member as $members){
            if($member->id_rep)
            $member->rep = DB::SELECT(DB::RAW("SELECT doc_iden,nom1,ape1,ape2 FROM SJL_representantes WHERE doc_iden='$member->id_rep'"));
            else  if($member->id_rep_lec)
            $member->rep = DB::SELECT(DB::RAW("SELECT doc_iden,nom1,ape1,ape2 FROM SJL_representantes WHERE doc_iden='$member->id_rep_lec'"));
            $member->hist_clubs = DB::SELECT(DB::RAW("SELECT distinct a.id_club ,b.nom FROM SJL_membresias a,sjl_clubes_lectura b WHERE '$member->doc_iden'=a.id_lec AND a.id_club=b.id"));
            foreach($club as $member->hist_clubs){
                $club->hist_grups = DB::SELECT(DB::RAW("SELECT j.id_grupo,j.id_club,j.id_fec_i,k.nom FROM SJL_Grupos_lectores j,SJL_grupos_lectura k WHERE '$member->doc_iden'=j.id_lec AND '$club->id_club'=j.id_club AND j.id_club=k.id_club AND j.id_grup=k.id"));
                $club->pagos = DB::SELECT(DB::RAW("SELECT id,fec_emi FROM SJL_historicos_pagos_memb WHERE '$member->doc_iden'=id_lec AND '$club->id_club'=id_club "));
            }
            foreach($grupo as $member->hist_clubs->hist_grups){
                $grupo->inasist= DB::SELECT(DB::RAW("SELECT fec_reu_men FROM SJL_inansistencias WHERE '$grupo->id_club'=id_club AND '$grupo->id_grupo'=id_grupo AND '$member->doc_iden'=id_lec"));
            }
            $member->favs = DB::SELECT(DB::RAW("SELECT a.titulo_esp,b.pref FROM SJL_Libros a, SJL_Lista_favoritos b WHERE '$member->doc_iden'=b.id_lec AND a.isbn=b.id_lib"));
    }
    }
    public function play_detail(){
        $plays = DB::SELECT(DB::RAW("SELECT o.id as id_obra,o.nom as nom_obra,o.resum,l.id_lib,k.titulo_esp,k.autor,p.nom as nom_edit
                            FROM SJL_obras o,SJL_obras_libros l,sjl_libros k, sjl_editoriales p
                            WHERE l.id_obra=o.id AND l.id_lib=k.isbn AND k.id_edit=p.id                                  
                            "));
        foreach($play as $plays){
            $play->pers = DB::SELECT(DB::RAW("SELECT id,id_obra,nom FROM SJL_Personajes WHERE '$play->id_obra'=id_obra"));
            $play->performs = DB::SELECT(DB::RAW("SELECT a.fec, a.hora_i,b.nom,c.nom FROM SJL_historicos_presentaciones a, SJL_locales_eventos b,sjl_clubes_lectura c WHERE '$play->id_obra'= a.id_obra AND a.id_local=b.id AND a.id_club=c.id"));
        }

}

    public function perform_detail(){
        $clubs = DB::select(DB::raw("SELECT c.id,c.nom FROM SJL_clubes_lectura"));
        foreach($club as $clubs){
            $club->plays=DB::SELECT(DB::RAW("SELECT o.id as id_obra,o.nom as nom_obra,o.resum,l.id_lib,k.titulo_esp,k.autor,p.nom as nom_edit
            FROM SJL_obras o,SJL_obras_libros l,sjl_libros k, sjl_editoriales p,SJL_historicos_presentaciones h
            WHERE l.id_obra=o.id AND l.id_lib=k.isbn AND k.id_edit=p.id  AND o.id=h.id_obra AND '$club->id'=h.id_club                               
            "));
            foreach($play as $club->$plays){
                    $play->pers = DB::SELECT(DB::RAW("SELECT a.id,a.id_obra,nom FROM SJL_Personajes a,SJL_historicos_presentaciones h WHERE '$play->id_obra'=id_obra AND '$club->id'=h.id_club AND '$play->id_obra'=h.id_obra"));
                    $play->performs = DB::SELECT(DB::RAW("SELECT a.fec, a.hora_i,a.durac,a.valor,a.num_asist,a.costo,b.nom,c.nom FROM SJL_historicos_presentaciones a, SJL_locales_eventos b,sjl_clubes_lectura c WHERE '$play->id_obra'= a.id_obra AND a.id_local=b.id AND a.id_club=c.id"));
                    foreach($perform as $play->performs){
                        $perform->elenco = DB::SELECT(DB::RAW("SELECT b.doc_iden,b.nom1,b.ape1,b.ape2 FROM sjl_elenco_lectores a,sjl_lectores b Where '$perform->fec'=a.id_hist_pre AND '$club->id'=a.id_club AND '$play->id_obra'=a.id_obra AND a.id_lec=b.doc_iden ")); 
                    }
            }
    }
    }

    public function booksperclub($id,$fechai,$fechaf){        
        $club = DB::SELECT(DB::RAW("SELECT id,nom from sjl_clubes_lectura where '$id'=id"));
        
        $books=DB::select(DB::raw("SELECT l.isbn,l.titulo_esp,(SELECT round((AVG(h.valor)),2) FROM SJL_reuniones_mensuales h,SJL_Libros j,SJL_grupos_lectura k,SJL_clubes_lectura o
        WHERE h.valor is not null AND l.isbn=h.id_lib AND h.id_grupo=k.id AND k.id_club=o.id AND o.id='$id' AND (a.fec BETWEEN '$fechai' AND '$fechaf')) as valoracion
          FROM SJL_reuniones_mensuales a,SJL_Libros l,SJL_grupos_lectura b,SJL_clubes_lectura c Where l.isbn=a.id_lib and a.id_grupo=b.id and a.valor is not null and a.id_grupo=b.id and b.id_club=c.id AND c.id='$id' AND (a.fec BETWEEN '$fechai' AND '$fechaf') ORDER BY l.isbn"));
        $name = 'libros_analizados_'.$club[0]->nom.'.pdf';
            $data = [
                'club' => $club,
                'books' => $books,
                'fechai' =>$fechai,
                'fechaf' =>$fechaf,
                'name' => $name
            ];
        $pdf = PDF::loadView('reports.lyzed', $data);        
        return $pdf->download($name);
    }
    public function fillbooksclub($id,Request $request){
        if($request->ajax()){
        $books= DB::SELECT(DB::RAW("SELECT distinct a.isbn,a.titulo_esp as titulo_en_español,a.titulo_ori as titulo_original,a.fec_pub as fecha_de_publicacion,a.autor from sjl_libros a where a.isbn=(SELECT b.id_lib FROM SJL_reuniones_mensuales b WHERE '$id'=b.id_club AND a.isbn=b.id_lib AND b.valor is not null limit 1) "));
        return Response::json(array('data'=>$books));
        }
    }
    public function clubbooks (Request $request){
        return $this->booksperclub($request->club,$request->fechai,$request->fechaf);
    }
    public function booksperclubpdf(Request $request){
        $pdf = file_get_contents($_POST[$pdf]);
        return $pdf->download($name);
    }

    public function clubformmember(Request $request, $id)
    {
        
        if ($request->ajax()){
            $members = DB::select(DB::raw("SELECT doc_iden, nom1 as nom, ape1 as ape, fec_nac, id_club FROM sjl_lectores WHERE id_club = '$id'"));
            return Response::json(array('members'=>$members,'club'=>$id));
        }
        else{
            return view ('members.managemembers');
        }
    }
    public function memberpdf($miembro,$club){
        $rep = '';
        $currentUMR = '';
        $currentCMR = '';
        $currentZMR = '';
        $currentPMR = '';
        $currentSMR = '';
        $representante ='';
        $clubdata = DB::SELECT(DB::RAW("SELECT id,nom,cuota from sjl_clubes_lectura where '$club'=id"));

        $member = Member::find($miembro);
        $Tedad = DB::select(DB::raw("SELECT DATE_PART('year', (SELECT CURRENT_DATE)::date) - DATE_PART('year',(SELECT fec_nac FROM SJL_lectores WHERE doc_iden='$miembro')) as edad"));
        $edad = $Tedad[0]->edad;
       
                if ($member->genero == 'M')
                $member->genero = "Masculino";
                else $member->genero = "Femenino";

                $telefonos = DB::select(DB::raw("SELECT cod_pais || '' || cod_area || '' || num as numero
                FROM sjl_telefonos WHERE id_lector = '$miembro'"));
                $currentP = DB::select(DB::raw("SELECT nom FROM sjl_paises WHERE id = '$member->id_nac'"));
                $currentPM = $currentP[0]->nom;
        
                $currentCMB = DB::select(DB::raw("SELECT e.nom as text, e.id || '-' || e.id_pais as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e WHERE ca.id = '$member->id_calle' AND ca.id_urb = u.id AND u.id_ciudad = e.id"));
                $currentCM = $currentCMB[0]->text;
        
                $currentUMB = DB::select(DB::raw("SELECT u.nom as nombre from sjl_calles ca, sjl_urbanizaciones u WHERE ca.id = '$member->id_calle' AND ca.id_urb = u.id"));
                $currentUM = $currentUMB[0]->nombre;
                    
                $currentSMB = DB::select(DB::raw("SELECT ca.nom as nombre from sjl_calles ca WHERE ca.id = '$member->id_calle'"));
                $currentSM = $currentSMB[0]->nombre;
        
                $currentZMB = DB::select(DB::raw("SELECT cod_post as code from sjl_calles WHERE id = '$member->id_calle'"));
                $currentZM = $currentZMB[0]->code;


            $representados = DB::SELECT(DB::RAW("SELECT doc_iden,(nom1|| ' ' ||(case when nom2 is not null then nom2||''else '' end))as nom,ape1,id_club as club_act,id_grup as grup_act FROM SJL_Lectores WHERE id_rep_lec='$miembro'"));
            $groups = DB::SELECT(DB::RAW("SELECT j.id_grupo,j.id_club,j.id_fec_i,j.fec_f,k.nom FROM SJL_Grupos_lectores j,SJL_grupos_lectura k WHERE '$member->doc_iden'=j.id_lec AND '$club'=j.id_club AND j.id_club=k.id_club AND j.id_grupo=k.id"));
            $inasistencias = DB::SELECT(DB::RAW("SELECT fec_reu_men,id_grupo FROM SJL_inansistencias WHERE '$club'=id_club AND '$member->doc_iden'=id_lec"));
            $pagos = DB::SELECT(DB::RAW("SELECT id,fec_emi FROM SJL_historicos_pagos_memb WHERE '$member->doc_iden'=id_lec AND '$club'=id_club "));
            $favs = DB::SELECT(DB::RAW("SELECT a.titulo_esp,b.pref,a.autor FROM SJL_Libros a, SJL_Lista_favoritos b WHERE '$member->doc_iden'=b.id_lec AND a.isbn=b.id_lib ORDER BY b.pref asc"));
            if ($edad < 18){
                if ($member->id_rep != null)
                    $representante = Representante::find($member->id_rep);
                else $representante = Member::find($member->id_rep_lec);
    
                $currentPR = DB::select(DB::raw("SELECT p.nom as text, p.id as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e, sjl_paises p WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id AND u.id_ciudad = e.id AND e.id_pais = p.id"));
                $currentPMR = $currentPR[0]->text;
        
                $currentCMBR = DB::select(DB::raw("SELECT e.nom as text, e.id || '-' || e.id_pais as value from sjl_calles ca, sjl_urbanizaciones u, sjl_ciudades e WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id AND u.id_ciudad = e.id"));
                $currentCMR = $currentCMBR[0]->text;
        
                $currentUMBR = DB::select(DB::raw("SELECT u.nom as nombre from sjl_calles ca, sjl_urbanizaciones u WHERE ca.id = '$representante->id_dir' AND ca.id_urb = u.id"));
                $currentUMR = $currentUMBR[0]->nombre;
                    
                $currentSMBR = DB::select(DB::raw("SELECT ca.nom as nombre from sjl_calles ca WHERE ca.id = '$representante->id_dir'"));
                $currentSMR = $currentSMBR[0]->nombre;
        
                $currentZMBR = DB::select(DB::raw("SELECT cod_post as code from sjl_calles WHERE id = '$representante->id_dir'"));
                $currentZMR = $currentZMBR[0]->code;      
    
            }
            $newedad= compact($Tedad);
            
        $data = [
            'member' => $member,
            'edad'=> $edad,
            'telefonos'=> $telefonos,
            'pais'=> $currentPM,
            'ciudad'=> $currentCM,
            'urbanizacion'=> $currentUM,
            'calle'=> $currentSM,
            'zipcode'=> $currentZM,
            'paisR'=> $currentPMR,
            'ciudadR'=> $currentCMR,
            'urbanizacionR'=> $currentUMR,
            'calleR'=> $currentSMR,
            'zipcodeR'=> $currentZMR,            
            'clubdata' => $clubdata[0],
            'favorites' => $favs,
            'rep' => $representante,
            'representados' => $representados,
            'groups' => $groups,
            'inasistencias' => $inasistencias,
            'pagos' => $pagos,
        ];
        $name = 'reporte_miembro_'.$member->doc_iden.'_club_'.$club.'.pdf';
    $pdf = PDF::loadView('reports.membersclub',$data);        
    return $pdf->download($name);
    }


    public function castclub(Request $request){
        return $this->memberpdf($request->miembro,$request->club);
    }

    public function performpdf($fec,$obra,$local,$club){
        $presentaciones = DB::select(DB::raw("SELECT p.fec, (
            SELECT o.nom FROM sjl_obras o WHERE p.id_obra = o.id
        )nombre, (
            SELECT l.nom FROM sjl_locales_eventos l WHERE l.id = p.id_local
        )lugar, (select to_char(p.hora_i::time, 'HH12:MI AM')) as hora_i, (select to_char(p.durac::time, 'HH12:MI')) as durac, p.valor, p.id_local as idlugar, p.id_obra as obra,p.costo,p.num_asist,(p.costo * p.num_asist) as recaudado
        FROM sjl_historicos_presentaciones p WHERE p.id_club = '$club' AND p.fec='$fec' AND p.id_obra='$obra' AND p.id_local='$local' AND p.valor is not null "));
        $clubdata = DB::SELECT(DB::RAW("SELECT id,nom FROM SJL_clubes_lectura WHERE id='$club'"));
        $elenco = DB::select(DB::raw("SELECT e.id_hist_pre as presentacion, e.id_pers, e.id_lec, e.id_obra as obra, e.id_club as club, e.id_local as local, (
            SELECT nom1 || ' ' || ape1 as actor from sjl_lectores WHERE doc_iden = e.id_lec
        ), (
            SELECT nom as personaje from sjl_personajes WHERE id = e.id_pers AND id_obra = e.id_obra
        ), (
            CASE WHEN e.mej_act = 'true' THEN 'Si' ELSE 'No' END) as mejor
        , e.id_fec_mem as membresia, (CASE WHEN (
            SELECT principal FROM sjl_elenco WHERE id_fec_mem = e.id_fec_mem AND id_lec = e.id_lec AND id_club = e.id_club AND id_pers = e.id_pers AND id_obra = e.id_obra
        ) = 'true' THEN 'Si' ELSE 'No' END) as principal FROM sjl_elenco_lectores e WHERE e.id_club = '$club' AND e.id_hist_pre = '$fec' AND e.id_obra = '$obra' AND e.id_local = '$local'"));
        $data= [
            'presentacion' => $presentaciones,
            'elenco' => $elenco,
            'clubdata' => $clubdata,
        ];
                $name = 'reporte_presentacion_club_'.$fec.'.pdf';
                $pdf = PDF::loadView('reports.performrep',$data);        
                return $pdf->download($name);    
    }

    public function performclub(Request $request){
        return $this->performpdf($request->fec,$request->obra,$request->local,$request->club);
    }

    public function fillperform($club,$fechai,$fechaf,Request $request){
        if($request->ajax()){
        $presentaciones = DB::select(DB::raw("SELECT p.fec, (
            SELECT o.nom FROM sjl_obras o WHERE p.id_obra = o.id
        )nombre, (
            SELECT l.nom FROM sjl_locales_eventos l WHERE l.id = p.id_local
        )lugar, (select to_char(p.hora_i::time, 'HH12:MI AM')) as hora_i, (select to_char(p.durac::time, 'HH12:MI')) as durac, p.valor, p.id_local as idlugar, p.id_obra as obra FROM sjl_historicos_presentaciones p WHERE id_club = '$club' AND p.fec BETWEEN '$fechai' AND '$fechaf' AND p.valor is not null"));
        
            return Response::json(array('data'=>$presentaciones));
        }
        else{
            $data = [
                'idclub' => $club,
                'fechai' => $fechai,                
                'fechaf' =>$fechaf,                
            ];
            return view('reports.club_perform')->with($data);
        }
    }
    public function playpdf($obra,$fechai,$fechaf){
        $obras = DB::select(DB::raw("SELECT o.id, o.nom as obra, o.resum as resumen, (
            SELECT l.titulo_esp FROM sjl_libros l WHERE o.id ='$obra' AND l.isbn = ol.id_lib AND  o.id = ol.id_obra  
        )libro_base FROM sjl_obras o, sjl_obras_libros ol WHERE '$obra'=o.id AND'$obra' = ol.id_obra"));
        $valorprom = DB::SELECT (DB::RAW("SELECT round((AVG(valor)),2)as valor FROM sjl_historicos_presentaciones WHERE fec BETWEEN '$fechai' AND '$fechaf' AND id_obra='$obra' "));
        $futurepres = DB::select(DB::raw("SELECT p.fec,(SELECT a.nom FROM SJL_clubes_lectura a WHERE a.id=p.id_club) as club_nom, (
            SELECT o.nom FROM sjl_obras o WHERE p.id_obra = o.id)nombre,
            (SELECT l.nom FROM sjl_locales_eventos l WHERE l.id = p.id_local)lugar
            ,(select to_char(p.hora_i::time, 'HH12:MI AM')) as hora_i,
            (select to_char(p.durac::time, 'HH12:MI')) as durac,
            p.id_local as idlugar, p.id_obra as obra,p.costo,
            (SELECT count(a.id_obra) FROM SJL_elenco_lectores a 
                WHERE '$obra'=a.id_obra AND p.id_local=a.id_local AND p.fec=a.id_hist_pre AND p.id_club=a.id_club) as numact
                    FROM sjl_historicos_presentaciones p
 WHERE '$obra'=p.id_obra AND p.fec BETWEEN '$fechai' AND '$fechaf' AND p.valor is null order by p.fec desc"));
        $pastpres = DB::select(DB::raw("SELECT p.fec,(SELECT a.nom FROM SJL_clubes_lectura a WHERE a.id=p.id_club) as club_nom, (
            SELECT o.nom FROM sjl_obras o WHERE p.id_obra = o.id)nombre,
            (SELECT l.nom FROM sjl_locales_eventos l WHERE l.id = p.id_local)lugar
            ,(select to_char(p.hora_i::time, 'HH12:MI AM')) as hora_i,
            (select to_char(p.durac::time, 'HH12:MI')) as durac, p.valor,p.num_asist,
            p.id_local as idlugar, p.id_obra as obra,p.costo,(p.costo * p.num_asist) as recaudado,
            (SELECT count(a.id_obra) FROM SJL_elenco_lectores a 
                WHERE '$obra'=a.id_obra AND p.id_local=a.id_local AND p.fec=a.id_hist_pre AND p.id_club=a.id_club) as numact
                    FROM sjl_historicos_presentaciones p
            
 WHERE '$obra'=p.id_obra AND p.fec BETWEEN '$fechai' AND '$fechaf' AND p.valor is not null order by p.fec desc"));
        $personajes=DB::SELECT(DB::RAW("SELECT id,id_obra,nom FROM SJL_Personajes WHERE '$obra'=id_obra"));
        
        $data=[
            'obras' => $obras,
            'futurepres' =>$futurepres,
            'pastpres' =>$pastpres,
            'personajes' =>$personajes,
            'valorprom' =>$valorprom,
            'fechai' =>$fechai,
            'fechaf' =>$fechaf
        ];
        $name = 'reporte_obra_'.$obra.'.pdf';
        $pdf = PDF::loadView('reports.play',$data);
        return $pdf->download($name);
    }
    public function playreport(Request $request){
        return $this->performpdf($request->obra,$request->fechai,$request->fechaf);
    }

}


