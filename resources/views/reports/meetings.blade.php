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
        <h1>Ficha de Reuniones</h1>
        <h2>{{$club->nom}}</h2>
    </div>
    @foreach ($groups as $group)
        @if($club->id == $group->id_club)
            <div>
                <h4><strong>Grupo: </strong> {{$group->nom}}</h4>
            </div>
            @if($group->n_reu > 0)
                @foreach ($meetings as $meeting)
                    @if($group->id == $meeting->id_grupo)
                        <div>
                            <hr>
                            <p>
                                <strong>Fecha de reunión: </strong> {{$meeting->fec}}<br>
                                <strong>Numero de sesión: </strong> {{$meeting->n_ses}}<br>
                                <strong>Moderador: </strong> {{$meeting->moder}}<br><br>
                                <strong>Libro analizado: </strong> {{$meeting->titulo_ori}}<br>
                                @if($meeting->valor == '')
                                <strong>Valoracion del libro: </strong> No valorado aún<br>
                                @else
                                    <strong>Valoración del libro: </strong> {{$meeting->valor}}/5 <br>
                                    <strong>Concluciones del libro: </strong> {{$meeting->conclu}}
                                @endif
                            </p>
                        </div>
                        <div class='text-center'><strong>Asistencia de miembros</strong></div>
                        <div style="margin-left:50px">
                            @foreach($members as $member)
                                @if($meeting->fec == $member->fec and $meeting->id_grupo == $member->id_grupo)
                                    <p>
                                        {{$member->fullnom}}  -          
                                        @if($member->asistencia == 'A')
                                            Asistente
                                        @else
                                            Inasistente
                                        @endif
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @else
                <p><strong>El grupo no ha tenido reuniones</strong></p>
            @endif
        @endif
    @endforeach
</body>
</html>