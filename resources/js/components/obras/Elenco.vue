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
                                    <h4 class="card-title">Elenco</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link href="#" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear elenco
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="material-datatables">
                                        <table class="table table-sales table-hover table-no-bordered" id="myTable" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Personaje</th>
                                                    <th class="text-center">Actor</th>
                                                    <th class="text-center">¿Es principal?</th>
                                                    <th class="text-center">¿Mejor actor?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in presentaciones" :key="index">
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="td-actions text-center">
                                                        <b-link href="#" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
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
