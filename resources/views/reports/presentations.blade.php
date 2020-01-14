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
        <h1>Ficha de presentaciones</h1>
        <h2>{{$club->nom}}</h2>
    </div>
    @if($club->n_pres > 0)
        <div class='text-center'><strong>Presentaciones</strong></div>
        @foreach($presentations as $presentation)
            @if($club->id == $presentation->id_club)
                <hr>
                <p>
                    <strong>Obra: </strong> {{$presentation->obra}}<br>
                    <strong>Lugar: </strong> {{$presentation->lcl}}<br>
                    <strong>Fecha y hora: </strong> {{$presentation->fec}} - {{$presentation->hora_i}}<br>
                    @if($presentation->valor == '')
                        <strong>Valoración pendiente</strong>
                    @else
                        <strong>Valoración: </strong> {{$presentation->valor}}/5
                    @endif
                </p>
                @if($presentation->n_act > 0)
                    <div class='text-center'><strong>Mejores actores</strong></div>
                    @foreach($actors as $actor)
                        @if($club->id == $actor->id_club && $presentation->id_obra == $actor->id_obra && $presentation->fec = $actor->fec)
                        <ul>
                            <li>
                            <strong>{{$actor->fullnom}}</strong>   en el papel de   <strong>{{$actor->pers}}</strong>                    
                            </li>
                        </ul>
                        @endif
                    @endforeach
                @endif
            @endif
        @endforeach
    @else
        <p class='text-center'><strong>El Club no tiene presentaciones registradas</strong></p>
    @endif
</body>
</html>