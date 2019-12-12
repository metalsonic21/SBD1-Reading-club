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
        <br>
            <b-row>
                <b-col cols="4">
                    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$member->doc_iden}}</p>
                </b-col>
                <b-col cols="4">
                    <p><strong>PRIMER NOMBRE:</strong> {{$member->nom1}}</p>
                </b-col>

                <b-col cols="4">
                    <p><strong>SEGUNDO NOMBRE: </strong>{{$member->nom2}}</p>
                </b-col>
                </b-row>

                <b-row>


                    <b-col cols="4">
                    <p><strong>PRIMER APELLIDO: </strong>{{$member->ape1}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>SEGUNDO APELLIDO: </strong>{{$member->ape2}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>FECHA DE NACIMIENTO: </strong>{{$member->fec_nac}}</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                    <p><strong>GÉNERO: </strong>{{$member->genero}}</p>
                    </b-col>

                </b-row>
                <hr>

                <b-row>
                    <b-col cols="4">
                        <h6> <strong>TELÉFONOS</strong></h6>
                    </b-col>
                </b-row>
                

                @if ($telefonos)
                @foreach ($telefonos as $telefono)
                <b-row>
                    <b-col cols="6">
                    <p> <strong>NÚMERO: </strong>{{$telefono->numero}}</p>
                    </b-col>
                </b-row>
                @endforeach
                @endif
                <hr>

                <b-row>
                    <b-col cols="4">
                    <h6> <strong>DIRECCIÓN</strong></h6>
                    </b-col>
                </b-row>
                <hr>
                <b-row>
                    <b-col cols="4">
                    <p><strong>PAÍS:</strong> {{$pais}}</p>
                    </b-col>
                    <b-col cols="4">
                    <p><strong>CIUDAD:</strong> {{$ciudad}}</p>
                    </b-col>
                    <b-col cols="4">
                    <p><strong>URBANIZACIÓN:</strong> {{$urbanizacion}}</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                    <p><strong>CALLE:</strong> {{$calle}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>CÓDIGO POSTAL:</strong> {{$zipcode}}</p>
                    </b-col>
                </b-row>
            <hr>

                <b-row>
                    <b-col cols="6">
                        <h6><strong>LIBROS FAVORITOS</strong></h6>
                    </b-col>
                </b-row>
                <br>

                @if ($favorites)
                @foreach ($favorites as $book)
                <b-row>
                    <b-col cols="4">
                    <p><strong>NOMBRE: </strong>{{$book->titulo_esp}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>AUTOR: </strong>{{$book->autor}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>PREFERENCIA: </strong>{{$book->pref}}</p>
                    </b-col>
                </b-row>
                @endforeach
                @endif
            
            <hr>
            @if ($edad < 18)
            <div id="datos_rep">
                <b-row>
                    <b-col cols="6">
                        <h6><strong>DATOS DE REPRESENTANTE</strong></h6>
                    </b-col>
                </b-row>
                <br>
            
                <b-row>
                <b-col cols="4">
                <p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$representante->doc_iden}}</p>
                </b-col>
                <b-col cols="4">
                <p><strong>PRIMER NOMBRE:</strong> {{$representante->nom1}}</p>
                </b-col>
                <b-col cols="4">
                <p><strong>SEGUNDO NOMBRE: </strong>{{$representante->nom2}}</p>
                    </b-col>
                </b-row>

                <b-row>

                    <b-col cols="4">
                    <p><strong>PRIMER APELLIDO: </strong>{{$representante->ape1}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>SEGUNDO APELLIDO: </strong>{{$representante->ape2}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>FECHA DE NACIMIENTO: </strong>{{$representante->fec_nac}}</p>
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
                    <p><strong>PAÍS:</strong> {{$paisR}}</p>
                    </b-col>
                    <b-col cols="4">
                    <p><strong>CIUDAD:</strong> {{$ciudadR}}</p>
                    </b-col>
                    <b-col cols="4">
                    <p><strong>URBANIZACIÓN:</strong> {{$urbanizacionR}}</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                    <p><strong>CALLE:</strong> {{$calleR}}</p>
                    </b-col>

                    <b-col cols="4">
                    <p><strong>CÓDIGO POSTAL:</strong> {{$zipcodeR}}</p>
                    </b-col>
                </b-row>
                </div>
            @endif
        </div>
    </div>
@endsection