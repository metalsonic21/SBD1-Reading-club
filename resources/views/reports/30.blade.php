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

    table {
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }


    .page_break { page-break-after: always; }
</style>
<body>

    @foreach ($clubs as $club)
        <div class="jumbotron text-center">
        <h1>{{$club->nom}}</h1>
        </div>

        @if ($club->i > 0)
            <table>
                <tr>
                    <th class="text-center">Documento de identidad</th>
                    <th class="text-center">Nombre</th>
                </tr>
            
            @foreach ($na as $n)
                @if ($n->id_club == $club->id)
                    <tr>
                        <td>{{$n->victimid}}</td>
                        <td>{{$n->victim}}</td>
                    </tr>
                @endif
            @endforeach
            </table>
        @else
            <p class="text-center">
                <strong>Este club no tiene miembros con más del 30% de inasistencias</strong>
            </p>
        @endif
        <div class="page_break"></div>
    @endforeach
</body>
</html>
