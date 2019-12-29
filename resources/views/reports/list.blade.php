@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


<!-- DESIGN HERE -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-log card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="card-title">Lista de reportes disponibles</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="material-datatables">
                                    <table class="table table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-justify">Nombre</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-justify">Ficha libros</td>

                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r1>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">2</td>

                                                <td class="text-justify">Libros analizados por club</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r2>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>

                                                <td class="text-left">Ficha cronológica club</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r3>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">4</td>

                                                <td class="text-left">Ficha clubes</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r4>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">5</td>

                                                <td class="text-left">Ficha miembros de club</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r5>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">6</td>

                                                <td class="text-left">Ficha presentación</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r6>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">7</td>

                                                <td class="text-left">Ficha obra</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r7>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">8</td>

                                                <td class="text-left">Ficha reunión</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r8>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">9</td>

                                                <td class="text-left">Reputación presentaciones</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r9>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">10</td>

                                                <td class="text-left">Inasistencias</td>
                                                <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-default" v-b-modal.r10>
                                                        <i class="material-icons">comment</i> Información del reporte
                                                    </button>
                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-info">
                                                        <i class="material-icons">cloud_download</i> Descargar reporte
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<!-- INFO -->
<b-modal size="md" id="r1" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha libros</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR LIBRO:</strong></h6>
                    <ul>
                        <li>Datos del libro</li>
                        <li>Estructura del libro</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>

<b-modal size="md" id="r2" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Libros analizados por club</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR CLUB:</strong></h6>
                    <ul>
                        <li>Nombre del libro</li>
                        <li>Valoración</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>

<b-modal size="md" id="r3" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha cronológica club</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR CLUB:</strong></h6>
                    <ul>
                        <li>Lista de miembros de cada club ordenada por fecha de ingreso de cada miembro</li>
                        <li>Libros analizados durante la estadía de cada miembro
                            <ol>
                                <li>Nombre de libro</li>
                            </ol>
                        </li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r4" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha club</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR CLUB:</strong></h6>
                    <ul>
                        <li>Grupos
                            <ol>
                                <li>Día disponible</li>
                                <li>Hora disponible</li>
                            </ol>
                        </li>
                        <li>Clubes asociados</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r5" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha miembros de club</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR MIEMBRO:</strong></h6>
                    <ul>
                        <li>Grupos en los que ha estado</li>
                        <li>Pagos</li>
                        <li>Inasistencias</li>
                        <li>Datos de representante (si aplica)</li>
                        <li>Libros favoritos</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r6" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha presentaciones</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR PRESENTACIÓN:</strong></h6>
                    <ul>
                        <li>Nombre de obra</li>
                        <li>Ganancia total</li>
                        <li>Valoración final</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r7" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha obras</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR OBRA:</strong></h6>
                    <ul>
                        <li>Personajes de la obra</li>
                        <li>Datos básicos de la obra</li>
                        <li>Presentaciones planificadas
                            <ol>
                                <li>Elenco de cada presentación</li>
                            </ol>
                        </li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r9" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Reputación presentaciones</h4>
            <small>Por obra</small>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR PRESENTACIÓN:</strong></h6>
                    <ul>
                        <li>Lista de presentaciones realizadas</li>
                        <li>Valoración de cada presentación</li>
                        <li>Mejores actores</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r8" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Ficha reuniones</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR REUNIÓN:</strong></h6>
                    <ul>
                        <li>Datos</li>
                        <li>Inasistencias</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>


<b-modal size="md" id="r10" ok-variant="default" ok-only ok-title="Ok">
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">book</i>
            </div>
            <h4 class="card-title">Inasistencias</h4>
        </div>
        <div class="card-body ">
            <b-row>
                <b-col cols="12">
                    <h6><strong>CONTIENE POR CLUB:</strong></h6>
                    <ul>
                        <li>Lista de miembros con 30% o más de inasistencias</li>
                    </ul>
                </b-col>
            </b-row>
        </div>
    </div>
</b-modal>
    </div>
</div>


</div>

@endsection