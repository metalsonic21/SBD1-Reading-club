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
                                    <i class="material-icons">add</i>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h4 class="card-title">Editar libro</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <b-form method="POST" action="/books/{{$book->isbn}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="isbn">ISBN</label>
                                                    <b-form-input type="text" value="{{$book->isbn}}" id="isbn" name="isbn" placeholder="Tip: el ISBN tiene 5 caracteres"></b-form-input>
                                                </b-col>
    
                                                <b-col cols="4">
                                                    <label for="titulo_ori">Título Original</label>
                                                    <b-form-input type="text" value="{{$book->titulo_ori}}" id="titulo_ori" name="titulo_ori" placeholder="Título original"></b-form-input>
                                                </b-col>
    
                                                <b-col cols="4">
                                                    <label for="titulo_esp">Título en Español</label>
                                                    <b-form-input type="text" value="{{$book->titulo_esp}}" id="titulo_esp" name="titulo_esp" placeholder="Título en español"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="tema_princ">Tema principal</label>
                                                    <b-form-textarea type="text" value="{{$book->tema_princ}}" id="tema_princ" placeholder="Tema principal" name="tema_princ"></b-form-textarea>
                                                </b-col>
    
                                            </b-row>
                                            <hr>
                                            <b-row>
                                                <b-col cols="12">
                                                    <label for="sinop">Sinopsis</label>
                                                    <b-form-textarea size="lg" value="{{$book->sinop}}" rows="8" id="sinop" name="sinop" placeholder="Sinopsis"></b-form-textarea>
                                                </b-col>
                                            </b-row>
                                            <hr>
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="n_pag">Número de páginas</label>
                                                    <b-form-input id="n_pag" value="{{$book->n_pag}}" name="n_pag" placeholder="Número de páginas"></b-form-input>
                                                </b-col>
    
                                                <b-col cols="4">
                                                    <label for="fec_pub">Fecha de publicación</label>
                                                    <b-form-input type="date" value="{{$book->fec_pub}}" id="fec_pub" name="fec_pub"></b-form-input>
                                                </b-col>
    
                                                <b-col cols="4">
                                                    <label for="editorial">Editorial</label>
                                                    <select name="editorial" id="editorial" class="form-control">
                                                        @foreach ($editoriales as $editorial)
                                                            @if($editorial->id == $book->id_edit)
                                                                <option value="{{$editorial->id}}" selected>{{$editorial->nom}}</option>
                                                            @else <option value="{{$editorial->id}}">{{$editorial->nom}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="autor">Autor</label>
                                                    <b-form-input  id="autor" value="{{$book->autor}}"  name="autor" placeholder="Autor"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <hr>
    
                                            <b-row>
                                                <b-col cols="6">
                                                    <h6><strong>GÉNEROS Y SUBGÉNEROS</strong></h6>
                                                </b-col>
                                            </b-row>
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="genero">Genero</label>
                                                    <select name="genero" id="genero" class="form-control">
                                                        @foreach ($generos as $genero)
                                                            @if($genero->id == $currentgenero[0]->id_gen)
                                                                <option value="{{$genero->id}}" selected>{{$genero->nom}}</option>
                                                            @else <option value="{{$genero->id}}">{{$genero->nom}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </b-col>
    
                                                <b-col cols="6">
                                                    <label for="subg">Subgenero</label>
                                                    <select name="subgenero" id="subgenero" class="form-control">
                                                            <option value="">Seleccionar</option>
                                                            @foreach ($subgeneros as $subgenero)
                                                                @if($subgenero->id == $currentsubg[0]->id_gen)
                                                                    <option value="{{$subgenero->id}}" selected>{{$subgenero->nom}}</option>
                                                                @else <option value="{{$subgenero->id}}">{{$subgenero->nom}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                </b-col>
    
                                            </b-row>
                                            <br>
                                            <div class="d-flex flex-row-reverse bd-highlight">
                                                <b-button variant="default" type="submit">Continuar</b-button>
    
                                                <b-link class="btn btn-danger" href="/books">Cancelar</b-link>
                                            </div>
                                        </b-form>
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