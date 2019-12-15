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
            <h4 class="card-title">Detalles de grupo</h4>
        </div>
        <div class="card-body ">
            <br>
            <b-row>
                <b-col cols="4">
                    <p><strong>NOMBRE:</strong> {{$g->nom}}</p>
                </b-col>
                <b-col cols="4">
                    @if ($g->tipo == 'A')
                    <p><strong>TIPO:</strong> Grupo de adultos</p>
                    @endif

                    @if ($g->tipo == 'J')
                    <p><strong>TIPO:</strong> Grupo de jóvenes</p>
                    @endif

                    @if ($g->tipo == 'N')
                    <p><strong>TIPO:</strong> Grupo de niños</p>
                    @endif
                </b-col>
                <b-col cols="4">
                    <p><strong>NÚMERO DE MIEMBROS:</strong> {{$g->miembros}}</p>
                </b-col>
            </b-row>

            <hr>
            <b-row>
                <b-col cols="6">
                    <h6><strong>DISPONIBILIDAD</strong></h6>
                </b-col>
            </b-row>
            <br>
            <b-row>
                <b-col cols="4">
                    @if ($g->dia == 2)
                    <p><strong>DÍA: </strong>Lunes</p>
                    @endif

                    @if ($g->dia == 3)
                    <p><strong>DÍA: </strong>Martes</p>
                    @endif

                    @if ($g->dia == 4)
                    <p><strong>DÍA: </strong>Miercoles</p>
                    @endif

                    @if ($g->dia == 5)
                    <p><strong>DÍA: </strong>Jueves</p>
                    @endif

                    @if ($g->dia == 6)
                    <p><strong>DÍA: </strong>Viernes</p>
                    @endif
                </b-col>

                <b-col cols="4">
                    <p><strong>HORA INICIO: </strong>{{$g->horai}}</p>
                </b-col>

                <b-col cols="4">
                    <p><strong>HORA FIN: </strong>{{$g->horai}}</p>
                </b-col>
            </b-row>
        </div>
    </div>
</div>
@endsection