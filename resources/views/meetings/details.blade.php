@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Detalles reunión</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="4">
                    <p><strong>LIBRO:</strong> {{$meeting->titulo}}</p>
                </b-col>
                <b-col cols="6">
                <p><strong>FECHA DE SESIÓN:</strong> {{$meeting->fecha}} de {{$meeting->hora_i}} a {{$meeting->hora_f}}</p>
                </b-col>
            </b-row>
            <b-row>
                <b-col cols="4">
                    <p><strong>MODERADOR:</strong> {{$meeting->moderador}}</p>
                </b-col>
                <b-col cols="4">
                <p><strong>SESIÓN #:</strong> {{$meeting->n_ses}}</p>
                </b-col>
            </b-row>

            @if ($meeting->conclu || $meeting->valor)
            <hr>
            <b-row>
                <b-col cols="6">
                    <h6><strong>CONCLUSIONES</strong></h6>
                </b-col>
            </b-row>
            <b-row>
                <b-col cols="4">
                <p><strong>VALORACIÓN:</strong> {{$meeting->valor}}</p>
                </b-col>
            </b-row>
            <b-row>
                <b-col cols="12">
                    <p><strong>COMENTARIOS: </strong>{{$meeting->conclu}} </p>
                </b-col>
            </b-row>
            @endif
            <hr>
            <b-row>
                <b-col>
                    <h6><strong>INASISTENCIAS</strong></h6>
                </b-col>
            </b-row>
            <br>
            @if ($inas)
            @foreach ($inas as $i)
                
                <b-row>
                    <b-col cols="1">
                    <p><strong>{{$loop->iteration}}</strong></p>
                    </b-col>

                    <b-col cols="6">
                    <p><strong>NOMBRE: </strong>{{$i->nombre}}</p>
                    </b-col>
                </b-row>
                @endforeach
            @else
                <b-row>
                    <b-col cols="6">
                        <p><strong>NO HUBO INASISTENCIAS PARA ESTA REUNIÓN</strong></p>
                    </b-col>
                </b-row>
            @endif
            
        </div>
    </div>
</div>
@endsection