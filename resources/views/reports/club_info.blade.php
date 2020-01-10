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
<div class="jumbotron text-center">
<h1>{{$club->nom}}</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3>Grupos</h3>
            @if ($grupos)
            @foreach ($grupos as $grupo)
                @if ($grupo->club == $club->id)
                    <p>
                        <strong>Nombre: </strong> {{$grupo->nom}} <br>
                        <strong>Tipo: </strong> Grupo de {{$grupo->tipo}} <br>
                        <strong>Horario disponible: </strong> {{$grupo->dia}}, {{$grupo->horario}} <br>
                    </p>
                @endif
            @endforeach
            @else
                    <p><strong>Este club no tiene ningún grupo registrado</strong></p>
            @endif
        </div>
        </div>
    </div>
    
    <div class="container" style="margin-left:430px">
        <div class="row">
            <div class="col-sm-12">
                <h3>Clubes asociados</h3>
                @if ($associated)
                @foreach ($associated as $a)
                    @if ($a->idone == $club->id)
                        <ul>
                            <li>
                                {{$a->clubtwo}}
                            </li>
                        </ul>
                    @endif
    
                    @if ($a->idtwo == $club->id)
                    <ul>
                        <li>
                            {{$a->clubone}}
                        </li>
                    </ul>
                    @endif
                @endforeach
                @else
                        <p><strong>Este club no está asociado a ningún club</strong></p>
                @endif
            </div>
            </div>
        </div>
</body>
</html>
