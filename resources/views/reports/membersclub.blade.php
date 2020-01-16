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
    <div class='jumbotron text-center'>
    <h1>Reporte de miembro</h1>
    <h1> Miembro: {{$member->nom1}} {{$member->nom2}} {{$member->ape1}} {{$member->ape2}}</span></h1>
    <h2>Club: {{$clubdata->nom}}</span></h2>
    </div>
    <hr>
    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$member->doc_iden}}</p>
<p><strong>NOMBRE(S):</strong> {{$member->nom1}} {{$member->nom2}}</p>
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
@if ($zipcode)
<p><strong>CÓDIGO POSTAL:</strong> {{$zipcode}}</p>
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
    <hr>
    <h6> <strong>DIRECCIÓN</strong></h6>
    <p><strong>PAÍS:</strong> {{$paisR}}</p>
    <p><strong>CIUDAD:</strong> {{$ciudadR}}</p>
    <p><strong>URBANIZACIÓN:</strong> {{$urbanizacionR}}</p>
    <p><strong>CALLE:</strong> {{$calleR}}</p>
    <p><strong>CÓDIGO POSTAL:</strong> {{$zipcodeR}}</p>
@endif
@if ($favorites)
<hr>
<br>
<br>
<hr>
<p><strong>Libros Favoritos</strong> </p>
<ol>
                @foreach ($favorites as $book)                
                <li><strong>TITULO: </strong>{{$book->titulo_esp}}  <strong>AUTOR: </strong>{{$book->autor}}</li>
                @endforeach
</ol>
@endif
<hr>
@if ($groups)
<br>
<br>
    <p><strong>Lista de grupos</strong> </p>
        <ul>
            @foreach ($groups as $group)
            <p><strong>Nombre:</strong> {{$group->nom}} - ID Grupo : {{$group->id_grupo}}</p>
            <li>Fecha de ingreso: {{$group->id_fec_i}}</li>
            @if ($group->fec_f)
            <li>Fecha de egreso: {{$group->fec_f}}</li>
            <li>Duracion {{(($group->id_fec_i)-($group->fec_f))}}</li>
            @else 
            <li>Status: Activo</li>
            @endif
            @if ($inasistencias)
                <ol>
                    @foreach ($inasistencias as $inasistencia)
                        @if ($group->id_grupo==$inasistencia->id_grupo)
                        <strong>Inasistencias</strong> <br>
                        <li>{{$inasistencia->fec_reu_men}}</li>
                        @endif
                    @endforeach
                </ol>
            @endif
            @endforeach
        </ul>
        <br>
@endif
@if ($pagos)
<p><strong>Historial de pagos: </strong></p>
    <P><STRONG>Cuota: </STRONG> {{$clubdata->cuota}}</P>
    <ol>
        @foreach ($pagos as $pago)
        <li>Numero de pago: {{$pago->id}} - Fecha de pago: {{$pago->fec_emi}}</li>
        @endforeach
    </ol>
    <br>
@endif
@if ($representados)
<hr>
    @foreach($representados as $representado)
    <p><strong>Datos del representado:</strong></p>
    <p><strong>DOCUMENTO DE IDENTIDAD:</strong> {{$representado->doc_iden}}</p>
    <p><strong>PRIMER NOMBRE:</strong> {{$representado->nom1}}</p>
    <p><strong>SEGUNDO NOMBRE: </strong>{{$representado->nom2}}</p>
    <p><strong>PRIMER APELLIDO: </strong>{{$representado->ape1}}</p>
    <p><strong>SEGUNDO APELLIDO: </strong>{{$representado->ape2}}</p>
    <p><strong>FECHA DE NACIMIENTO: </strong>{{$representado->fec_nac}}</p>
    @endforeach 
@endif
</body>
</html>


