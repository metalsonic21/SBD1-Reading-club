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
                                    <h4 class="card-title">Seleccione grupo de lectura</h4>
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
                                                    <th class="text-center">Día disponible</th>
                                                    <th class="text-center">Horario disponible</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Acheron River</td>
                                                    <td class="text-center">Lunes</td>
                                                    <td class="text-center">9:00 AM - 11:00 AM</td>
                                                    <td class="td-actions text-center">
                                                    <b-link href="/managemeetings">    <button type="button" rel="tooltip" class="btn btn-default"> Seleccionar 
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


</div>
</template>

<script>
export default {

}
</script>

<style>

</style>
