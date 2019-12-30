<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .jumbotron {
    padding: 2rem 1rem;
    margin-bottom: 2rem;
    background-color: #e9ecef;
    border-radius: .3rem
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box
    }

    html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent
    }

    .text-center {
        text-align: center !important
    }
    
    .container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto
    }

    .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px
    }

    .text-justify {
    text-align: justify !important
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2
    }

    .h1,
    h1 {
        font-size: 2.5rem
    }

    .h2,
    h2 {
        font-size: 2rem
    }

    .h3,
    h3 {
        font-size: 1.75rem
    }

    .h4,
    h4 {
        font-size: 1.5rem
    }

    .h5,
    h5 {
        font-size: 1.25rem
    }

    .h6,
    h6 {
        font-size: 1rem
    }

    .page_break { page-break-after: always; }
</style>
<body>

@foreach ($books as $book)
<div class="jumbotron text-center">
<h1>{{$book->titulo_ori}}</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-4">
        <br><br><br>
        <img src="./img/pdfs/poster.png" alt="" style="width:250px;height:250px;">
        <div style="margin-top:-50px">
            <h5 style="margin-left:70px">Estructura</h5>
            @foreach ($structs as $struct)
                @if ($struct->lib == $book->isbn)
                    <p>{{$struct->fullnom}}</p>
                @endif
            @endforeach
        </div>
    </div>
    
    <div class="col-sm-8" style="margin-left:300px">
      <h5>Información</h5>
    <p><strong>Título en Español: </strong>{{$book->titulo_esp}} <br>
    <strong>Autor: </strong> {{$book->autor}} <br>
    <strong>Número de páginas: </strong> {{$book->n_pag}} <br> 
    <strong>Género: </strong> {{$book->genero}} <br>
    <strong>Subgéneros: </strong> {{$book->subgenero}} <br>
    <strong>Tema principal: </strong> {{$book->tema_princ}}
    </p>

    <h5>Sinopsis</h5>
        <p class="text-justify">{{$book->sinop}}</p>
    </div>
    <div class="page_break"></div>
  </div>
</div>
@endforeach
</body>
</html>
