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
                                <div class="col-lg-5">
                                    <h4 class="card-title">Reuniones para el grupo</h4>
                                </div>
                                <div class="col-lg-7">
                                    <b-link href="/managemeetings/calendar" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">calendar_today</i>
                                        </span>
                                        Consultar calendario
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
                                                    <th class="text-center">Libro</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Grupo</th>
                                                    <th class="text-center">Moderador</th>
                                                    <th class="text-center">Sesión</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Juan Salvador Gaviota</td>
                                                    <td class="text-center">05-12-2019</td>
                                                    <td class="text-center">Acheron River</td>
                                                    <td class="text-center">Frank Hesse</td>
                                                    <td class="text-center">1</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.meeting-details>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Control de asistencia para esta reunión" class="btn btn-default" v-b-modal.attendance>
                                                            <i class="material-icons">list</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" v-b-modal.add-meeting data-placement="bottom" title="Programar reunión" class="btn btn-success">
                                                            <i class="material-icons" >edit</i>
                                                        </button>
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
    <set-meeting></set-meeting>
    <meeting-attendance></meeting-attendance>
    <meeting-details></meeting-details>
</div>
</template>

<script>
export default {
    
}
</script>

<style>

</style>
