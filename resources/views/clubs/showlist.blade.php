@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- DESIGN HERE -->
<div>
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
                                    <h4 class="card-title">Seleccione un club de lectura</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="material-datatables">
                                        <table class="table table-sales table-hover table-no-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Fecha de creación</th>
                                                    <th class="text-center">Idioma</th>
                                                    <th class="text-center">País</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clubs as $club)
                                                <tr>
                                                    <td class="text-center">{{$club->nom}}</td>
                                                    <td class="text-center">{{$club->fec_crea}}</td>
                                                    <td class="text-center">{{$club->idioma}}</td>
                                                    <td class="text-center">{{$club->direccion}}</td>
                                                    <td class="td-actions text-center">
                                                    @if ($current == 1)
                                                        <b-link href="/clubs/{{$club->id}}/members" class="btn btn-default">Seleccionar</b-link>
                                                    @endif
                                                    @if ($current == 2)
                                                        <b-link href="/clubs/{{$club->id}}/groups" class="btn btn-default">Seleccionar</b-link>
                                                    @endif

                                                    @if ($current == 3)
                                                        <b-link href="/clubs/{{$club->id}}/selectgm" class="btn btn-default">Seleccionar</b-link>
                                                    @endif

                                                    @if ($current == 4)
                                                    <a href="{{ route('selectgroupr', ['club' => $club->id])  }}" class="btn btn-default">Seleccionar</a>
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach


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


</div>

@endsection