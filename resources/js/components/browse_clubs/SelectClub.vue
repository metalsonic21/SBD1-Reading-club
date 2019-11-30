<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">group</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Seleccione un club de lectura</h4>
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
                                                    <th class="text-center">Prueba 1</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Frank Hesse</td>
                                                    <td class="td-actions text-center">
                                                    <b-link href="/managemembers">    <button type="button" rel="tooltip" class="btn btn-info"> Seleccionar 
                                                        </button></b-link>
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

    <b-modal size="lg" id="add-club" ok-variant="info" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">Añadir nuevo club</h4>
            </div>
            <div class="card-body ">
                <b-form>

                </b-form>
            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="view-club" ok-variant="info" cancel-variant="danger" ok-title="Añadir miembro a este club" cancel-title="Cerrar">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">Detalles de club</h4>
            </div>
            <div class="card-body ">
                <b-form>

                </b-form>

            </div>
        </div>
    </b-modal>

    
    <b-modal size="lg" id="edit-club" ok-variant="info" cancel-variant="danger" ok-title="Modificar" cancel-title="Cancelar">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Modificar club</h4>
            </div>
            <div class="card-body ">
                <b-form>

                </b-form>

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
