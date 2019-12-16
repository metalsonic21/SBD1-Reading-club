<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">videocam</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Obras actuadas</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link href="/obras/create" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear nueva obra
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
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Libro relacionado</th>
                                                    <th class="text-center">Resumen</th>
                                                    <th class="text-center">Acción</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in obras" :key="index">
                                                    <td class="text-center">{{item.nom}}</td>
                                                    <td class="text-center">{{item.libro}}</td>
                                                    <td class="text-center">{{item.resum}}</td>

                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/obras/'+item.id+'/edit'" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar la obra
                                                                </div>
                                                                <div>
                                                                    <code>{{item.nom}} sobre el libro {{item.libro}}</code>
                                                                </div>
                                                            </template>
                                                            <div>
                                                                <b-button class="btn btn-danger btn-block" @click="borrar(item)">Eliminar</b-button>
                                                            </div>
                                                            <b-button class="mt-3" block @click="hideModal(index)">Cancelar</b-button>
                                                        </b-modal>
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
    data() {
        return {
            obras: [],
        }
    },
    created() {
        axios.get(`/obras`)
            .then(res => {
                this.obras = res.data.data;
                console.log(this.obras);
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {
        showModal(item) {
            item = item.toString();
            this.$bvModal.show(item);
        },
        hideModal(item) {
            item = item.toString();
            this.$bvModal.hide(item);
        },
        borrar(item) {
            axios.delete(`/obras/${item.id}`)
                .then(res => {
                    window.location = `/obras`;
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>
