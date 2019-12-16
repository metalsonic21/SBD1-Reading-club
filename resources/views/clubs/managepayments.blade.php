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
                                <i class="material-icons">euro</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                <h4 class="card-title">Control de pagos para {{$member->nom1}} {{$member->ape1}}</h4>
                                </div>
                                <div class="col-lg-5">

                                <b-link href="/clubs/{{$club}}/members/{{$member->doc_iden}}/payments/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Registrar nuevo pago
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
                                                    <th class="text-center">Código</th>
                                                    <th class="text-center">Fecha de emisión de pago</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pagos as $pago)
                                                <tr>
                                                    <td class="text-center">{{$pago->id}}</td>
                                                    <td class="text-center">{{$pago->fechapago}}</td>
                                                        <td class="td-actions text-center">
                                                        <b-link href="/clubs/{{$club}}/members/{{$member->doc_iden}}/payments/{{$pago->id}}/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click=";$bvModal.show('bv-modal-{{$loop->iteration}}') "><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal id="bv-modal-{{$loop->iteration}}" hide-footer>
                                                                    <template v-slot:modal-title>
                                                                    <div>
                                                                    Por favor confirme que desea eliminar el pago
                                                                    </div><div>
                                                                    <code>{{$pago->id}}</code> 
                                                                    </div>
                                                                    </template>                                                          
                                                                    <div>                                                                
                                                                    {!! Form::open(['route'=> ['payments.destroy', $club, $member->doc_iden, $pago->id], 'method'=>'DELETE']) !!}
                                                                    {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                                    {!! Form::close() !!}
                                                                    </div>
                                                                    <b-button class="mt-3" block @click=";$bvModal.hide('bv-modal-{{$loop->iteration}}')">Cancelar</b-button>
                                                        </b-modal>
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