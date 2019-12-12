@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


<!-- DESIGN HERE -->

<div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Detalles de miembro</h4>
        </div>
        <div class="card-body ">
            
                <b-row>
                <b-col cols="8">
                    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> 123456789101112131415</p>
                </b-col>
                <b-col cols="4">
                    <p><strong>PRIMER NOMBRE:</strong> Frank</p>
                </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>SEGUNDO NOMBRE: </strong></p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>PRIMER APELLIDO: </strong>Hesse</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>SEGUNDO APELLIDO: </strong></p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="5">
                        <p><strong>FECHA DE NACIMIENTO: </strong>{{fec_nac}}</p>
                    </b-col>

                    <b-col cols="3">
                        <p><strong>GÉNERO: </strong>Masculino</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>TELÉFONO: </strong>1234567891011</p>
                    </b-col>
                </b-row>
                <hr>
                <b-row>
                    <b-col cols="4">
                    <h6> <strong>DIRECCIÓN</strong></h6>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="4">
                        <p><strong>PAÍS:</strong> Alemania</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CIUDAD:</strong> Dresden</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CALLE:</strong> Something</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>URBANIZACIÓN:</strong> Something2</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                    </b-col>
                </b-row>
            <hr>
            <div id="datos_rep" v-if="mayoredad == false">
                <b-row>
                    <b-col cols="6">
                        <h6><strong>DATOS DE REPRESENTANTE</strong></h6>
                    </b-col>
                </b-row>
            
                <b-row>
                <b-col cols="8">
                    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> 123456789101112131415</p>
                </b-col>
                <b-col cols="4">
                    <p><strong>PRIMER NOMBRE:</strong> Frank</p>
                </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>SEGUNDO NOMBRE: </strong></p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>PRIMER APELLIDO: </strong>Hesse</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>SEGUNDO APELLIDO: </strong></p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="5">
                        <p><strong>FECHA DE NACIMIENTO: </strong>01-08-1999</p>
                    </b-col>

                    <b-col cols="3">
                        <p><strong>GÉNERO: </strong>Masculino</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>TELÉFONO: </strong>1234567891011</p>
                    </b-col>
                </b-row>
                <hr>
                <b-row>
                    <b-col cols="4">
                    <h6> <strong>DIRECCIÓN</strong></h6>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="4">
                        <p><strong>PAÍS:</strong> Alemania</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CIUDAD:</strong> Dresden</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CALLE:</strong> Something</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>URBANIZACIÓN:</strong> Something2</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                    </b-col>
                </b-row>
                </div>
                
        </div>
    </div>
@endsection