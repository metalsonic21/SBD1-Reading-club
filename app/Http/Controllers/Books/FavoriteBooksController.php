<?php

namespace App\Http\Controllers\Books;
use App\Models\Lista;
use App\Models\Book;
use App\Models\Member;
use DB;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $idclub, $id)
    {        
        if($request->ajax()){
            $books = DB::select(DB::raw("SELECT isbn, titulo_esp as titulo_en_español, titulo_ori as titulo_original, fec_pub as fecha_de_publicacion, autor from sjl_libros"));
            $member = Member::find($id);
            return Response::json(array('data'=>$books,'member'=>$member));
        }
        else{
            return view('books.favorites');
        }
        //return $id;
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
        DB::table('sjl_lista_favoritos')
        ->where('id_lec',$request->member)
        ->delete();

        $bookOne = new Lista();
        $bookOne->id_lec = $request->member;
        $bookOne->id_lib = $request->selectedone;
        $bookOne->pref = $request->prefOne;
        $bookOne->save();

        $bookTwo = new Lista();
        $bookTwo->id_lec = $request->member;
        $bookTwo->id_lib = $request->selectedtwo;
        $bookTwo->pref = $request->prefTwo;
        $bookTwo->save();

        $bookT = new Lista();
        $bookT->id_lec = $request->member;
        $bookT->id_lib = $request->selectedthree;
        $bookT->pref = $request->prefThree;
        $bookT->save();

        //return $request->selectedtwo;
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
        //
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
