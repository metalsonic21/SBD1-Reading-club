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
                                <i class="material-icons">library_books</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Estructura del libro {{$name}}</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link  href="/books/{{$isbn}}/structure/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear sección/capítulo
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <b-row>
                                <b-col cols="12">
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombre Estructura</th>
                                                    <th class="text-center">Nombre Sección</th>
                                                    <th class="text-center">Número</th>
                                                    <th class="text-center">Título Sección</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($fullstructure as $struct)
                                                <tr>
                                                    <td class="text-center">{{$struct->structname}}</td>
                                                    <td class="text-center">{{$struct->nom}}</td>
                                                    <td class="text-center">{{$struct->num}}</td>
                                                    <td class="text-center">{{$struct->titulo}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link href="/books/{{$isbn}}/structure/{{$struct->id}}/edit" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <div class="d-inline-block">
                                                            {!! Form::open(['route'=> ['structure.destroy', $isbn, $struct->id, $isbn], 'method'=>'DELETE']) !!}
                                                            {!! Form::button('<i class="material-icons">close</i>', ['type' => 'submit','class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </b-col>
                            </b-row>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection