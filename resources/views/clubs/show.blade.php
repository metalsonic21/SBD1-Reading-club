@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- DESIGN HERE -->
<template>
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card ">
                <div class="card-header card-header-log card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">book</i>
                    </div>
                    <h4 class="card-title">Detalles de club</h4>
                </div>
                <div class="card-body ">
                    
                    <b-row>
                        <b-col cols="6">
                            <p><strong>NOMBRE: </strong>{{$club->nom}}</p>
                        </b-col>
                        <b-col cols="6">
                            <p><strong>IDIOMA: </strong>{{$idioma[0]->idiom}}</p>
                        </b-col>
                        </b-row>
                        <hr>
                        <b-row>
                            <b-col cols="4">
                            <h6> <strong>DIRECCIÓN</strong></h6>
                            </b-col>
                        </b-row>
                        <br>
                        <b-row>
                            <b-col cols="4">
                                <p><strong>PAÍS: </strong> {{$direccion[0]->pais}}</p>
                            </b-col>
                            <b-col cols="4">
                                <p><strong>CIUDAD: </strong>{{$direccion[0]->ciudad}}</p>
                            </b-col>
                            <b-col cols="4">
                                <p><strong>CALLE: </strong>{{$direccion[0]->calle}}</p>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col cols="4">
                                <p><strong>URBANIZACIÓN: </strong> {{$direccion[0]->urb}}</p>
                            </b-col>

                            <b-col cols="4">
                                <p><strong>CÓDIGO POSTAL: </strong>{{$direccion[0]->codigo}}</p>
                            </b-col>
                        </b-row>

                        @if ($club->cuota)
                        <hr>
                        <b-row>
                            <b-col cols="6">
                                <h6><strong>CUOTA DEL CLUB</strong></h6>
                            </b-col>
                        </b-row>
                        <br>                       
                        <b-row>
                            <b-col cols="6">
                                <p><strong>CUOTA: </strong>{{$club->cuota}}</p>
                            </b-col>
                            <b-col cols="6">
                                <p><strong>MONEDA: </strong>{{$direccion[0]->moneda}}</p>
                            </b-col>
                        </b-row>
                        
                           
                        
                        @endif

                        @if ($asoc[0]->inst)
                        <hr>
                        <b-row>
                            <b-col cols="6">
                                <h6><strong>INSTITUCIÓN ASOCIADA</strong></h6>
                            </b-col>
                        </b-row>
                        <br>
                        
                        <b-row>
                            <b-col cols="6">
                                <p><strong>NOMBRE: </strong>{{$asoc[0]->inst }}</p>
                            </b-col>

                            <b-col cols="6">
                                <p><strong>TIPO: </strong>{{$asoc[0]->tipo }}</p>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col cols="6">
                                <p><strong>PAÍS: </strong>{{$asoc[0]->pais }}</p>
                            </b-col>
                            <b-col cols="6">
                                <p><strong>CIUDAD: </strong>{{$asoc[0]->ciudad }}</p>
                            </b-col>  
                        </b-row>
                        @endif

                        

                        <div>
                            @if ($aclubs)
                            <hr>
                            <b-row>
                                <b-col cols="6">
                                    <h6><strong>CLUBES ASOCIADOS</strong></h6>
                                </b-col>
                            </b-row>
                            @endif
                            @foreach($aclubs as $aclub)
                            <b-row>
                                <ul>
                                    <li>{{$aclub->nombre}}</li>
                                </ul>
                            </b-row>
                            @endforeach
                        </div>
                    </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
</template>


@endsection