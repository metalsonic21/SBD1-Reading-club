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
        <h1>{{$obras[0]->obra}}</h1>
    </div>
    <hr>
    <div>Entre las fechas: {{$fechai}}  -  {{$fechaf}}</div>
        <div class='text-center'><strong>Detalles de Presentación</strong></div>
                <hr>
                <p>
                    <strong>Resumen: </strong> {{$obras[0]->resumen}}<br>
                    <strong>Libro Base: </strong> {{$obras[0]->libro_base}}<br>
                    
                    <strong>Valoracion promedio: </strong> {{$valorprom[0]->valor}}<br>
                    @if ($personajes)
                    <strong>Personajes: </strong><br>
                    @foreach($personajes as $personaje)    
                        <ul>
                            <li><strong>{{$personaje->nom}} </strong> </li>
                        </ul>
                    @endforeach
                    @endif
                </p>
                    <div class='text-center'><strong>Presentaciones</strong></div><br>
                    @if($futurepres)
                    <strong>
                        Proximas
                    </strong>
                    <br>
                        @foreach($futurepres as $pres)
                            <ul>
                                <li>
                                    <strong>Obra: </strong> {{$pres->nombre}}<br>
                                    <strong>Lugar: </strong> {{$pres->lugar}}<br>
                                    <strong>Club: </strong> {{$pres->club_nom}}<br>
                                    <strong>Fecha: </strong> {{$pres->fec}} <br>
                                    <strong>Horario: </strong> {{$pres->hora_i}}<br>
                                    <strong>Duracion: </strong> {{$pres->durac}} <br>                                    
                                    <strong>Costo:</strong> {{$pres->costo}} <br>
                                    <strong>Cantidad de actores: </strong> {{$pres->numact}}<br>                        
                                </li>
                            </ul>
                        @endforeach
                    @endif

                    @if($pastpres)
                    <strong>
                        Realizadas
                    </strong>
                    <br>
                        @foreach($pastpres as $pres)
                            <ul>
                                <li>
                                    <strong>Obra: </strong> {{$pres->nombre}}<br>
                                    <strong>Lugar: </strong> {{$pres->lugar}}<br>
                                    <strong>Club: </strong> {{$pres->club_nom}}<br>
                                    <strong>Fecha: </strong> {{$pres->fec}} <br>
                                    <strong>Horario: </strong> {{$pres->hora_i}}<br>
                                    <strong>Duracion: </strong> {{$pres->durac}} <br>                                    
                                    <strong>Costo:</strong> {{$pres->costo}} <br>
                                    <strong>Valoración: </strong> {{$pres->valor}}/5 <br>
                                    <strong>Cantidad de actores: </strong> {{$pres->numact}}<br>
                                    <strong>Numero de asistentes:</strong> {{$pres->num_asist}} <br>
                                     <strong>Monto recaudado: </strong> {{$pres->recaudado}} <br>               
                                </li>
                            </ul>
                        @endforeach
                    @endif


    <div class='page_break'></div>

</body>
</html>