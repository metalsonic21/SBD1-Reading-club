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
<p>&nbsp;</p>
<div class="jumbotron text-center">
<h1><span style="background-color: #808080;">Reporte de miembro</span></h1>
<h1><span style="background-color: #808080;">Miembro:{{$member->nom}}{{$member->ape1}} {{$member->ape2}}</span></h1>
<h2><span style="background-color: #808080;">Club :{{$clubdata->nom}}</span></h2>
</div>
<div class="container">
<div class="row">
<div class="col-sm-4"><br /><br /><br /> <img style="width: 250px; height: 250px;" src="./img/pdfs/poster.png" alt="" />
<div style="margin-top: -50px;">
<h5 style="margin-left: 70px;">Datos Personales</h5>
<p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$member->doc_iden}}</p>
<p><strong>NOMBRE(S):</strong> {{$member->nom1}}</p>
<p><strong>PRIMER APELLIDO: </strong>{{$member->ape1}}</p>
<p><strong>SEGUNDO APELLIDO: </strong>{{$member->ape2}}</p>
<p><strong>FECHA DE NACIMIENTO: </strong>{{$member->fec_nac}}</p>
<p><strong>EDAD: </strong>{{$edad}}</p>
<p><strong>GÉNERO: </strong>{{$member->genero}}</p>
<hr>
<h6> <strong>TELÉFONOS</strong></h6>
@if ($telefonos)
                @foreach ($telefonos as $telefono)
                <p> <strong>NÚMERO: </strong>{{$telefono->numero}}</p>
                @endforeach
@endif
<hr>
<h6> <strong>DIRECCIÓN</strong></h6>
<p><strong>PAÍS:</strong> {{$pais}}</p>
<p><strong>CIUDAD:</strong> {{$ciudad}}</p>
<p><strong>URBANIZACIÓN:</strong> {{$urbanizacion}}</p>
<p><strong>CALLE:</strong> {{$calle}}</p>
<p><strong>CÓDIGO POSTAL:</strong> {{$zipcode}}</p>

@if ($favorites)
<hr>
<p>Libros Favoritos</p>
                @foreach ($favorites as $book)
                <p><strong>NOMBRE: </strong>{{$book->titulo_esp}}</p>
                <p><strong>AUTOR: </strong>{{$book->autor}}</p>
                @endforeach
@endif

@if ($rep)
<hr>
    <p><strong>Datos del representante:</strong></p>
    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$rep->doc_iden}}</p>
    <p><strong>PRIMER NOMBRE:</strong> {{$rep->nom1}}</p>
    <p><strong>SEGUNDO NOMBRE: </strong>{{$rep->nom2}}</p>
    <p><strong>PRIMER APELLIDO: </strong>{{$rep->ape1}}</p>
    <p><strong>SEGUNDO APELLIDO: </strong>{{$rep->ape2}}</p>
    <p><strong>FECHA DE NACIMIENTO: </strong>{{$rep->fec_nac}}</p>
    <h6> <strong>DIRECCIÓN</strong></h6>
    <p><strong>PAÍS:</strong> {{$paisR}}</p>
    <p><strong>CIUDAD:</strong> {{$ciudadR}}</p>
    <p><strong>URBANIZACIÓN:</strong> {{$urbanizacionR}}</p>
    <p><strong>CALLE:</strong> {{$calleR}}</p>
    <p><strong>CÓDIGO POSTAL:</strong> {{$zipcodeR}}</p>
@endif
</div>
</div>
</div>
</div>
</body>
</html>