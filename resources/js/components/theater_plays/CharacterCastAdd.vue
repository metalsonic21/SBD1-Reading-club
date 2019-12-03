<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">theaters</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Elenco</h4>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-default float-right mt-3" v-b-modal.add-character>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir nuevo personaje
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="text-center">Seleccione un personaje</h6>
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Elenco</th>
                                                    <th class="text-center">Personaje</th>
                                                    <th class="text-center">Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Juan Ramirez</td>
                                                    <td class="text-center">Roderick</td>
                                                    <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.details-character> Datos Personaje 
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

    <b-modal size="lg" id="add-character" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">add</i>
                    <i class="material-icons">person</i>
                </div>
                <h4 class="card-title">Añadir nuevo Personaje</h4>
            </div>
            <div class="card-body ">
                <b-form>

                </b-form>
            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="details-character" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">movie</i>
                </div>
                <h3 class="card-title">Roderick</h3>
            </div>
            <div class="card-body ">
                <b-form>
                    <h4>Decripción del personaje:</h4>
                    <p align="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni nam labore excepturi doloremque ut laboriosam nobis, exercitationem itaque perferendis sunt. Vero quaerat, modi alias suscipit architecto maiores nam quia, ut consequuntur sed qui nobis porro a quisquam temporibus perspiciatis expedita aliquam delectus accusamus magni eaque voluptatem harum odio! Dicta, ullam.</p>
                </b-form>
            </div>
        </div>
    </b-modal>



</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>