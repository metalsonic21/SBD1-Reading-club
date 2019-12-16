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
                                        <h4 class="card-title">Explorar clubes de lectura</h4>
                                    </div>
                                    <div class="col-lg-2">

                                        <b-link href="/browseclubs/create" class="btn btn-default float-right mt-3">
                                            <span class="btn-label">
                                                <i class="material-icons">add</i>
                                            </span>
                                            Crear club de lectura
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
                                                        <th class="text-center">Nombre</th>
                                                        <th class="text-center">Fecha de creación</th>
                                                        <th class="text-center">Idioma</th>
                                                        <th class="text-center">País</th>
                                                        <th class="text-center">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($clubs as $club)
                                                    <tr>
                                                        <td class="text-center">{{$club->nom}}</td>
                                                        <td class="text-center">{{$club->fec_crea}}</td>
                                                        <td class="text-center">{{$club->idioma}}</td>
                                                        <td class="text-center">{{$club->pais}}</td>
                                                        <td class="td-actions text-center">
                                                            <b-link href="{{ route('browseclubs.show',$club->id) }}" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                                <i class="material-icons">remove_red_eye</i>
                                                            </b-link>
                                                            <b-link href="/clubs/{{$club->id}}/members/create" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Añadir miembro" class="btn btn-default">
                                                                <i class="material-icons">person_add</i>
                                                            </b-link>
                                                            <b-link href="/browseclubs/{{$club->id}}/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                                <i class="material-icons">edit</i>
                                                            </b-link>
                                                            <b-link href="/browseclubs/{{$club->id}}/editassociated" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Asociar Clubes" class="btn btn-primary">
                                                                <i class="material-icons">people</i>
                                                            </b-link>

                                                            <b-button @click=";$bvModal.show('bv-modal-{{$loop->iteration}}')"  rel="tooltip" data-toggle="tooltip"  data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                                <i class="material-icons">close</i>
                                                            </b-button>

                                                            <b-modal id="bv-modal-{{$loop->iteration}}" hide-footer>
                                                                <template v-slot:modal-title>
                                                                <div>
                                                                Por favor confirme que desea eliminar el club
                                                                </div><div>
                                                                <code>{{$club->nom}}</code> 
                                                                </div>
                                                                </template>                                                                
                                                                <div>                                                                
                                                                {!! Form::open(['route'=> ['browseclubs.destroy', $club->id], 'method'=>'DELETE']) !!}
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
    </div>
</div>
@endsection