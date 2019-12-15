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
                                    <h4 class="card-title">Explorar grupos de lectura</h4>
                                </div>
                                <div class="col-lg-2">

                                <b-link href="/clubs/{{$club}}/groups/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear grupo de lectura
                                    </b-link>
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
                                                    <th class="text-center">Tipo</th>
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
                                                @if ($group->tipo == 'A')
                                                <td class="text-center">Grupo de Adultos</td>
                                                @endif

                                                @if ($group->tipo == 'J')
                                                <td class="text-center">Grupo de Jóvenes</td>
                                                @endif

                                                @if ($group->tipo == 'N')
                                                <td class="text-center">Grupo de Niños</td>
                                                @endif

                                                    <td class="td-actions text-center">
                                                        <b-link href="/clubs/{{$group->id_club}}/groups/{{$group->id}}" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link href="/clubs/{{$group->id_club}}/groups/{{$group->id}}/gmembers/create" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Añadir miembro" class="btn btn-default">
                                                            <i class="material-icons">person_add</i>
                                                        </b-link>
                                                    <b-link href="/clubs/{{$group->id_club}}/groups/{{$group->id}}/edit" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click=";$bvModal.show('bv-modal-{{$loop->iteration}}') "><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal id="bv-modal-{{$loop->iteration}}" hide-footer>
                                                            <template v-slot:modal-title>
                                                            <div>
                                                            Está apunto de eliminar al grupo
                                                            </div><div>
                                                            <code>{{$group->nom}}</code> 
                                                            </div>
                                                            </template>                                                          
                                                            <div>                                                                
                                                            {!! Form::open(['route'=> ['groups.borrar', $group->id_club, $group->id], 'method'=>'PUT']) !!}
                                                            {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                            {!! Form::close() !!}
                                                            </div>
                                                            <b-button class="mt-3" block @click=";$bvModal.hide('bv-modal-{{$loop->iteration}}')">Cancelar</b-button>
                                                </b-modal>

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

</div>
@endsection