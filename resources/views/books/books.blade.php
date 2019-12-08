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
                                <i class="material-icons">library_books</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Explorar libros</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link  href="/books/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear libro
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
                                                    <th class="text-center">Título en español</th>
                                                    <th class="text-center">Título original</th>
                                                    <th class="text-center">Editorial</th>
                                                    <th class="text-center">Fecha de publicación</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($books as $book)
                                                <tr>
                                                    <td class="text-center">{{$book->titulo_esp}}</td>
                                                    <td class="text-center">{{$book->titulo_ori}}</td>
                                                    <td class="text-center">{{$book->editorial}}</td>
                                                    <td class="text-center">{{$book->fec_pub}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link href="{{ route('books.show',$book->isbn) }}" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link href="/books/{{$book->isbn}}/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        {!! Form::open(['route'=> ['books.destroy', $book->isbn], 'method'=>'DELETE']) !!}
                                                        {!! Form::button('<i class="material-icons">close</i>', ['type' => 'submit','class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}

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