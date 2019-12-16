@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">theaters</i>
                            </div>
                            <div class="row">
                            <div class="col-lg-10">
                                    <h4 class="card-title">Funciones del club: {{$performances[0]->nombre_club}}</h4>
                                    <h4 class="card-title"><b>Para la obra: {{$performances[0]->nombre_obra}}</b></h4>
                            </div>
                                <div class="col-lg-2">
                                    <b-link  href="perform/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Agregar Nueva Funcion
                                    </b-link>
                                </div>                                
                            </div>
                        </div>
                        <div class="card-body">                        
                            <div class="row">
                                <div class="col-lg-12">                                    
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <tbody>                                            
                                                <tr>
                                                <b-modal size="lg" id="days-plays" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
                                                            <div class="card ">
                                                                <div class="card-header card-header-log card-header-icon">
                                                                    <div class="card-icon">
                                                                        <i class="material-icons">movie</i>
                                                                    </div>
                                                                    <h4 class="card-title">Presentaciones:</h4>
                                                                </div>
                                                                <div>
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Horario</th>
                                                                            <th>Duración</th>
                                                                            <th>Capacidad</th>                                                                            
                                                                            <th>Disponibilidad</th>
                                                                            <th>Acción</th>
                                                                        </tr>
                                                                        @foreach($performances as $performance)
                                                                        <tr>
                                                                            <td>{{$performance->fec}}</td>
                                                                            <td>{{$performance->hora_i}}</td>
                                                                            <td>{{$performance->durac}}</td>
                                                                            <td>{{$performance->cap}}</td>
                                                                            @if($performance->num_asist ==null){
                                                                                <td>Disponible</td> 
                                                                            }@else{
                                                                            <td>No disponible</td>
                                                                            }@endif
                                                                            <td class="td-actions text-center">
                                                                            <b-link href="perform/view" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                                                <i class="material-icons">remove_red_eye</i>
                                                                            </b-link>
                                                                            <b-link href="perform/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                                                <i class="material-icons">edit</i>
                                                                            </b-link>
                                                                            
                                                                            <b-button @click=";$bvModal.show('bv-modal3-{{$loop->iteration}}')"  rel="tooltip" data-toggle="tooltip"  data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                                                <i class="material-icons">close</i>
                                                                            </b-button>

                                                                            <b-modal id="bv-modal1-{{$loop->iteration}}" hide-footer>
                                                                                <template v-slot:modal-title>
                                                                                <div>
                                                                                Porfavor confirme que desea eliminar el club
                                                                                </div><div>
                                                                                <code></code> 
                                                                                </div>
                                                                                </template>                                                                
                                                                                <div>                                                                

                                                                                </div>
                                                                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal1-{{$loop->iteration}}')">Cancelar</b-button>
                                                                            </b-modal>
                                                                            
                                                                            <b-modal id="bv-modal2-{{$loop->iteration}}" hide-footer>
                                                                                <template v-slot:modal-title>
                                                                                <div>
                                                                                Porfavor confirme que desea eliminar el club
                                                                                </div><div>
                                                                                <code></code> 
                                                                                </div>
                                                                                </template>                                                                
                                                                                <div>                                                                

                                                                                </div>
                                                                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal2-{{$loop->iteration}}')">Cancelar</b-button>
                                                                            </b-modal>
                                                                            
                                                                            <b-modal id="bv-modal3-{{$loop->iteration}}" hide-footer>
                                                                                <template v-slot:modal-title>
                                                                                <div>
                                                                                Porfavor confirme que desea eliminar la presentacion
                                                                                </div><div>
                                                                                <code>{{$performance->fec}}+{{$performance->id_obra}}+{{$performance->id_local}}+{{$performance->id_club}}</code> 
                                                                                </div>
                                                                                </template>                                                                
                                                                                <div>

                                                                                        {!! Form::open(['method'=>'POST','route'=>['destroy',$performance->fec,$performance->id_obra,$performance->id_local,$performance->id_club]]) !!}
                                                                                        {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                                                        {!! Form::close() !!}
                                                                                </div>
                                                                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal3-{{$loop->iteration}}')">Cancelar</b-button>
                                                                            </b-modal>

                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>                
                                                                </div>
                                                            </div>       
                                                        </b-modal>
                                                    </td>
                                                </tr>
                                                
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