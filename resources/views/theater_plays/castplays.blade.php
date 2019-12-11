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
                                    <h4 class="card-title">Obras acutuadas por club</h4>
                                </div>
                                <div class="col-lg-2">
                                    <b-link  href="castplays/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Agregar Nueva Obra
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="text-center">Seleccione una obra</h6>
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Obras de teatro</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($plays as $play)
                                                <tr>
                                                    <td class="text-center">{{$play->nom}}</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.details-plays-{{$loop->iteration}}> Detalles 
                                                        </button>
                                                        <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.days-plays-{{$loop->iteration}}> Presentaciones 
                                                        </button> 
                                                    <b-link href="/charactercast"> <button type="button" rel="tooltip" class="btn btn-default"> Ver Elenco 
                                                        </button></b-link>
                                                        <button type="button" rel="tooltip" class="btn btn-danger" v-b-modal.bv-modal-{{$loop->iteration}}> Eliminar 
                                                        </button> 
                                                        <b-modal size="lg" id="details-plays-{{$loop->iteration}}" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
                                                            <div class="card ">
                                                                <div class="card-header card-header-log card-header-icon">
                                                                    <div class="card-icon">
                                                                        <i class="material-icons">movie</i>
                                                                    </div>
                                                                    <h4 class="card-title">{{$play->nom}}</h4>
                                                                </div>
                                                                <div class="card-body ">
                                                                    <b-form>
                                                                        <h2>Resumen:</h2>
                                                                        <p align="justify">{{$play->resum}}</p>
                                                                    </b-form>
                                                                </div>
                                                                <div >
                                                                    <table class="table">
                                                                            <tr>
                                                                                <td>Duracion obra:</td>
                                                                                <td>{{$play->duracion}} Hrs.</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Costo boleto:</td>
                                                                                <td>{{$play->costo}}$</td>
                                                                            </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </b-modal>
                                                                <b-modal id="bv-modal-{{$loop->iteration}}" hide-footer>
                                                                <template v-slot:modal-title>
                                                                <div>
                                                                Porfavor confirme que desea eliminar la obra
                                                                </div><div>
                                                                <code>{{$play->nom}} Y {{$play->id}}</code> 
                                                                </div>
                                                                </template>                                                                
                                                                <div>                                                                
                                                                {!! Form::open(['route'=> ['castplays.destroy', $play->id], 'method'=>'DELETE']) !!}
                                                                {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                                {!! Form::close() !!}
                                                                </div>
                                                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal')">Cancelar</b-button>
                                                                </b-modal>

                                                        <b-modal size="lg" id="days-plays-{{$loop->iteration}}" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
                                                            <div class="card ">
                                                                <div class="card-header card-header-log card-header-icon">
                                                                    <div class="card-icon">
                                                                        <i class="material-icons">movie</i>
                                                                    </div>
                                                                    <h4 class="card-title">Presentaciones:</h4>
                                                                    <h5 class="card-title">Todos los hijos de mis padres</h5>
                                                                </div>
                                                                <div >
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Horario</th>
                                                                            <th>Disponibilidad</th>
                                                                            <th># asistentes</th>
                                                                            <th>Valoración</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>15/10/2019</td>
                                                                            <td>20:00</td>
                                                                            <td>No disponible</td>
                                                                            <td>72</td>
                                                                            <td>4/5</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>14/01/2020</td>
                                                                            <td>17:00</td>
                                                                            <td>Disponible</td>
                                                                            <td>No disponible</td>
                                                                            <td>No disponible</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>15/01/2020</td>
                                                                            <td>17:00</td>
                                                                            <td>Disponible</td>
                                                                            <td>No disponible</td>
                                                                            <td>No disponible</td>
                                                                        </tr>
                                                                    </table>                
                                                                </div>
                                                                <p><b>Direccion de la presentacion:</b></p>
                                                                <p>p sherman, calle wallaby 42, sidney</p>
                                                            </div>       
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


@endsection