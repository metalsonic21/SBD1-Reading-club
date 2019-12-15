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
                                <div class="col-lg-4">
                                    <h4 class="card-title">Miembros del club</h4>
                                </div>
                                <div class="col-lg-8">

                                    <b-link href="/clubs/{{$club}}/members/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir nuevo miembro
                                    </b-link>

                                    <b-link href="/clubs/{{$club}}/freeagent" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">account_box</i>
                                        </span>
                                        Añadir agente libre
                                    </b-link>
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
                                                    <th class="text-center">Documento de identidad</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Apellido</th>
                                                    <th class="text-center">Fecha de nacimiento</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($members as $member)
                                                <tr>
                                                    <td class="text-center">{{$member->doc_iden}}</td>
                                                    <td class="text-center">{{$member->nom}}</td>
                                                    <td class="text-center">{{$member->ape}}</td>
                                                    <td class="text-center">{{$member->fec_nac}}</td>
                                                        <td class="td-actions text-center">
                                                        <b-link href="/clubs/{{$club}}/members/{{$member->doc_iden}}" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link href="/clubs/{{$club}}/members/{{$member->doc_iden}}/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click=";$bvModal.show('bv-modal-{{$loop->iteration}}') "><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal id="bv-modal-{{$loop->iteration}}" hide-footer>
                                                                    <template v-slot:modal-title>
                                                                    <div>
                                                                    Está apunto de eliminar al miembro
                                                                    </div><div>
                                                                    <code>{{$member->nom}} {{$member->ape}}</code> 
                                                                    </div>
                                                                    </template>                                                          
                                                                    <div>                                                                
                                                                    {!! Form::open(['route'=> ['members.changest', $member->id_club, $member->doc_iden], 'method'=>'PUT']) !!}
                                                                    {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                                    {!! Form::close() !!}
                                                                    </div>
                                                                    <b-button class="mt-3" block @click=";$bvModal.hide('bv-modal-{{$loop->iteration}}')">Cancelar</b-button>
                                                        </b-modal>

                                                        <b-link href="/clubs/{{$club}}/members/{{$member->doc_iden}}/payments" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Control de pagos" class="btn btn-warning">
                                                            <i class="material-icons">euro</i>
                                                        </b-link>
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

@endsection