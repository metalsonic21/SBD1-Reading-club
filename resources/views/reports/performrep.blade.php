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
        <h1>{{$clubdata[0]->nom}}</h1>
    </div>
        <div class='text-center'><strong>Detalles de Presentación</strong></div>
                <hr>
                <p>
                    <strong>Obra: </strong> {{$presentacion[0]->nombre}}<br>
                    <strong>Lugar: </strong> {{$presentacion[0]->lugar}}<br>
                    <strong>Fecha: </strong> {{$presentacion[0]->fec}} <br>
                    <strong>Horario: </strong> {{$presentacion[0]->hora_i}}<br>
                    <strong>Duracion: </strong> {{$presentacion[0]->durac}} <br>
                    <strong>Valoración: </strong> {{$presentacion[0]->valor}}/5 <br>
                    <strong>Costo:</strong> {{$presentacion[0]->costo}} <br>
                    <strong>Numero de asistentes:</strong> {{$presentacion[0]->num_asist}} <br>
                    <strong>Monto recaudado: </strong> {{$presentacion[0]->recaudado}} <br>
                </p>
                    <div class='text-center'><strong>Elenco</strong></div>
                    @foreach($elenco as $actor)                        
                        <ul>
                            <li>
                            <strong>{{$actor->actor}}</strong>   en el papel de   <strong>{{$actor->personaje}}</strong> <br>
                            @if($actor->principal=='Si') <strong>Como un personaje principal</strong>
                            @else <strong>Como un personaje secundario</strong>
                            @endif
                            @if($actor->mejor=='Si')<strong>Con mejor actuacion</strong> <br>@endif                                 
                            </li>
                        </ul>
                    @endforeach

    <div class='page_break'></div>

</body>
</html>