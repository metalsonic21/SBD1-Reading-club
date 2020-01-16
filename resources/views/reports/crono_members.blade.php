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
        line-height: 1.2;
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
    <div class="jumbotron text-center"><h1>Ficha Cronológica</h1><h2>{{$member->fullnom}}</h2></div>
    @foreach ($clubs as $club)
        <div>
            <hr>
            <p>
                <strong>Club: </strong>{{$club->nom}} <br>
                <strong>Desde: </strong>{{$club->fec_i}} 
                @if($club->fec_f != '')
                    <strong>Hasta: </strong>{{$club->fec_f}}<br>
                @else
                    <strong>Hasta: </strong>presente<br>
                @endif
            </p>
            @foreach ($groups as $group)
                @if($club->id_club == $group->id_club && $club->fec_i <= $group->fec_i && $club->fec_f >= $group->fec_f)
                <p>
                    <strong>Grupo: </strong>{{$group->nom}} <br>
                    <strong>Desde: </strong>{{$group->fec_i}} 
                    @if($group->fec_f != '')
                        <strong>Hasta: </strong>{{$group->fec_f}}<br>
                    @else
                        <strong>Hasta: </strong>presente<br>
                    @endif
                </p>
                @foreach($books as $book)
                    @if($group->fec_f == '')
                        @if($club->id_club == $book->id_club && $group->id_grupo == $book->id_grupo && $book->fec >= $group->fec_i)
                            <p>
                                <strong>Libro leido: </strong> {{$book->libro}} 
                            </p>
                        @endif
                    @else
                        @if($club->id_club == $book->id_club && $group->id_grupo == $book->id_grupo && $book->fec >= $group->fec_i && $book->fec <= $group->fec_f)
                            <p>
                                <strong>Libro leido: </strong> {{$book->libro}} 
                            </p>
                        @endif
                    @endif
                @endforeach
    
                @endif
            @endforeach
        </div>
    @endforeach
</body>
</html>
