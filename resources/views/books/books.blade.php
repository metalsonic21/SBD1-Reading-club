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
                                                        <b-link href="/books/{{$book->isbn}}/structure" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Explorar Estructura" class="btn btn-default">
                                                            <i class="material-icons">list</i>
                                                        </b-link>
                                                       <!-- <b-link href="/books/{{$book->isbn}}" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </b-link>                 -->                                 
                                                                                                               
                                                    <b-button class="btn btn-danger" id="show-btn" @click=";$bvModal.show('bv-modal') "><i class="material-icons">close</i>
                                                    <?php

                                                    ?>
                                                    </b-button>

                                                                                                                                                                                                     
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <b-modal id="bv-modal" hide-footer>
                                                                <template v-slot:modal-title>
                                                                <div>
                                                                Porfavor confirme que desea eliminar el libro
                                                                </div><div>
                                                                <code>{{$book->titulo_ori}}</code> 
                                                                </div>
                                                                </template>                                                                
                                                                <div>                                                                
                                                                {!! Form::open(['route'=> ['books.destroy', $book->isbn], 'method'=>'DELETE']) !!}
                                                                {!! Form::button('Eliminar', ['type' => 'submit','class' => 'btn btn-danger btn-block','size'=>'sm']) !!}
                                                                {!! Form::close() !!}
                                                                </div>
                                                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal')">Cancelar</b-button>
                                                            </b-modal>
                                                            </div>
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