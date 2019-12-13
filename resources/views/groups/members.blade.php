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
                            <h4 class="card-title">Miembros del grupo {{$grupo}}</h4>
                            </div>
                            <div class="col-lg-2">

                                <button class="btn btn-default float-right mt-3" v-b-modal.add-member>
                                    <span class="btn-label">
                                        <i class="material-icons">add</i>
                                    </span>
                                    Añadir nuevo miembro
                                </button>
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
                                                <th class="text-center">Documento de identidad</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Apellido</th>
                                                <th class="text-center">Fecha de nacimiento</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($members)
                                            @foreach ($members as $member)
                                            <tr>
                                                <td class="text-center">{{$member->doc_iden}}</td>
                                            <td class="text-center">{{$member->nom1}}</td>
                                            <td class="text-center">{{$member->ape1}}</td>
                                            <td class="text-center">{{$member->fec_nac}}</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-member>
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                        <i class="material-icons">close</i>
                                                    </button>
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