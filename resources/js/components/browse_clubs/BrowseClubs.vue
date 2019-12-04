<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">group</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Explorar clubes de lectura</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link href="/browseclubs/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear club de lectura
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Fecha de creación</th>
                                                    <th class="text-center">Idioma</th>
                                                    <th class="text-center">País</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Killer Bees</td>
                                                    <td class="text-center">12-12-2019</td>
                                                    <td class="text-center">Inglés</td>
                                                    <td class="text-center">Alemania</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-club>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <b-link href="/managemembers/create" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Añadir miembro" class="btn btn-default">
                                                            <i class="material-icons">person_add</i>
                                                        </b-link>
                                                        <b-link href="/browseclubs/1/edit" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
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

        </div>
    </div>

    <b-modal size="lg" id="add-club" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">Añadir nuevo club</h4>
            </div>
            <div class="card-body ">
                
            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="view-club" ok-variant="default" cancel-variant="danger" ok-title="Añadir miembro a este club" cancel-title="Cerrar">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">Detalles de club</h4>
            </div>
            <div class="card-body ">
                
                    <b-row>
                    <b-col cols="3">
                        <p><strong>NOMBRE:</strong> Killer Bees</p>
                    </b-col>
                    <b-col cols="3">
                        <p><strong>IDIOMA:</strong> Inglés</p>
                    </b-col>
                    </b-row>
                    <hr>
                    <b-row>
                        <b-col cols="4">
                        <h6> <strong>DIRECCIÓN</strong></h6>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">
                            <p><strong>PAÍS:</strong> Alemania</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CIUDAD:</strong> Dresden</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CALLE:</strong> Something</p>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <p><strong>URBANIZACIÓN:</strong> Something2</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                        </b-col>
                    </b-row>
                <hr>
                    <b-row>
                        <b-col cols="6">
                            <h6><strong>INSTITUCIÓN ASOCIADA</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <p><strong>NOMBRE: </strong>Leaf</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>TIPO: </strong>Biblioteca</p>
                        </b-col>
                    </b-row>

                    
                    <b-row>
                        <b-col cols="4">
                            <p><strong>PAÍS:</strong> Alemania</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CIUDAD:</strong> Dresden</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CALLE:</strong> Something</p>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <p><strong>URBANIZACIÓN:</strong> Something2</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                        </b-col>
                    </b-row>

                    <hr>

                    <b-row>
                        <b-col cols="6">
                            <h6><strong>CLUBES ASOCIADOS</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <ul>
                            <li>G59</li>
                        </ul>
                    </b-row>

            </div>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {

}
</script>

<style>

</style>
