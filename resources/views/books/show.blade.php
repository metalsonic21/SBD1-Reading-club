@extends('layouts.dashboard')
@section('content')
    
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- DESIGN HERE -->
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">library_books</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Detalles libro</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-row>
                                        <b-col cols="4">
                                            <p><strong>ISBN:</strong> {{$book->isbn}}</p>
                                        </b-col>
                                        <b-col cols="4">
                                            <p><strong>TÍTULO ORIGINAL:</strong> {{$book->titulo_ori}}</p>
                                        </b-col>
                                        
                                        <b-col cols="4">
                                                <p><strong>TÍTULO EN ESPAÑOL:</strong> {{$book->titulo_esp}}</p>
                                            </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col cols="4">
                                            <p><strong>AUTOR:</strong> {{$book->autor}}</p>
                                        </b-col>
                                        <b-col cols="4">
                                            <p><strong>NÚMERO DE PÁGINAS:</strong> {{$book->n_pag}}</p>
                                        </b-col>
                                        <b-col cols="4">
                                            <p><strong>EDITORIAL:</strong> {{$book->editorial}}</p>
                                        </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col cols="4">
                                            <p><strong>FECHA DE PUBLICACIÓN: </strong>{{$book->fec_pub}}</p>
                                        </b-col>

                                        <b-col cols="4">
                                            @if ($prev)
                                            <p><strong>PREDECESOR: </strong> {{$prev->titulo_esp}}</p>
                                            @endif
                                        </b-col>

                                        <b-col cols="4">
                                            <p><strong>TEMA PRINCIPAL: </strong>{{$book->tema_princ}}</p>
                                        </b-col>
                                    </b-row>
                                    <hr>
                                    <b-row>
                                        <b-col cols="12">
                                            <p><strong>SINOPSIS: </strong>{{$book->sinop}} </p>
                                        </b-col>
                                    </b-row>
                                    <hr>
                                    <b-row>
                                        <b-col cols="6">
                                            <h6><strong>ESTRUCTURA</strong></h6>
                                        </b-col>
                                    </b-row>
                                    @foreach ($structure as $struct)
                                    <b-row>
                                        <b-col cols="4">
                                            <p><strong>NOMBRE DE ESTRUCTURA: </strong>{{$struct->ename}}</p>
                                        </b-col>

                                        <b-col cols="4">
                                            <p><strong>TIPO DE ESTRUCTURA: </strong>{{$struct->tipo}}</p>
                                        </b-col>

                                        <b-col cols="4">
                                            <p><strong>TÍTULO DE ESTRUCTURA: </strong> {{$struct->etit}}</p>
                                        </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col cols="4">
                                            <p><strong>TÍTULO DE SECCIÓN: </strong>{{$struct->titulo}}</p>
                                        </b-col>

                                        <b-col cols="4">
                                            <p><strong>NÚMERO DE SECCIÓN: </strong>{{$struct->num}}</p>
                                        </b-col>

                                        <b-col cols="4">
                                            <p><strong>TÍTULO DE SECCIÓN: </strong>{{$struct->titulo}}</p>
                                        </b-col>
                                    </b-row>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection