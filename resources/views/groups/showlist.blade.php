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
                            <i class="material-icons">group</i>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="card-title">Seleccione grupo de lectura</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table-sales">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Día disponible</th>
                                                <th class="text-center">Horario disponible</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($groups)
                                            @foreach ($groups as $group)
                                            <tr>
                                            <td class="text-center">{{$group->nom}}</td>
                                            @if ($group->dia_sem == 2)
                                            <td class="text-center">Lunes</td>
                                            @endif

                                            @if ($group->dia_sem == 3)
                                            <td class="text-center">Martes</td>
                                            @endif

                                            @if ($group->dia_sem == 4)
                                            <td class="text-center">Miercoles</td>
                                            @endif

                                            @if ($group->dia_sem == 5)
                                            <td class="text-center">Jueves</td>
                                            @endif

                                            @if ($group->dia_sem == 6)
                                            <td class="text-center">Viernes</td>
                                            @endif

                                            <td class="text-center">{{$group->horario}}</td>
                                                <td class="td-actions text-center">
                                                @if ($current == 1)
                                                <b-link href="/clubs/{{$group->id_club}}/groups/{{$group->id}}/gmembers">    <button type="button" rel="tooltip" class="btn btn-default"> Seleccionar 
                                                    </button></b-link>
                                                @endif

                                                @if ($current == 2)
                                                <b-link href="#">    <button type="button" rel="tooltip" class="btn btn-default"> Seleccionar 
                                                </button></b-link>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
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