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
                                    <h4 class="card-title">Históricos miembros de club</h4>
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
                                                    <th class="text-center">Club actual</th>
                                                    <th class="text-center">Reportes disponibles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Frank Hesse</td>
                                                    <td class="text-center">Killer Bees</td>

                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados durante estadía de persona en club" class="btn btn-info" v-b-modal.view-club>
                                                            <i class="material-icons">comment</i> Libros analizados
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Histórico de pagos de membresía" class="btn btn-success">
                                                            <i class="material-icons">attach_money</i> Pagos
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Asistencia a reuniones" class="btn btn-default">
                                                            <i class="material-icons">list_alt</i> Actividad
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Clubes anteriores" class="btn btn-info">
                                                            <i class="material-icons">book</i> Clubes anteriores
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

    </div>
</template>

<script>
export default {
    
}
</script>

<style>
    
</style>