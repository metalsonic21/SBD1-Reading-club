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
                            <i class="material-icons">done</i>
                        </div>
                    <h4 class="card-title">Bienvenido {{Auth::user()->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <b-row>
                                    <b-col cols="6">
                                        <h6><strong>FUNCIONALIDADES</strong></h6>
                                    </b-col>
                                </b-row>

                                <b-row>
                                    <b-col cols="6">
                                        <ol>
                                            <li>Gestión de clubes
                                            <ol>
                                             <li>Agregar y administrar miembros</li>
                                             <li>Agregar locales para obras</li>
                                             <li>Asociar clubes con otros clubes</li>
                                            </ol>
                                            </li>
                                            <li>Gestión de grupos
                                            <ol>
                                             <li>Agregar y administrar miembros</li>
                                            </ol>
                                            <li>Gestión de Reuniones
                                                <ol>
                                                 <li>Programar y administrar reuniones</li>
                                                 <li>Asistencia de miembros</li>
                                                </ol>
                                            </li>
                                            <li>Gestión de libros con estructura</li>
                                            <li>Gestión de obras de teatro
                                                <ol>
                                                    <li>Gestión de personajes para una obra</li>
                                                    <li>Gestión de presentaciones por club</li>
                                                    <li>Elenco de presentaciones</li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </b-col>
                                </b-row>

                                <b-row>
                                    <b-col cols="12">
                                        <h6 class="text-center"><strong>Seleccione una opción del menú de la izquierda para comenzar</strong></h6>
                                    </b-col>
                                </b-row>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
