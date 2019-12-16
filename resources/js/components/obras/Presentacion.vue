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
                                    <h4 class="card-title">Presentaciones</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link v-bind:href="'/clubs/'+club+'/presentaciones/create'" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear presentación
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
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Obra</th>
                                                    <th class="text-center">Local</th>
                                                    <th class="text-center">Hora de inicio</th>
                                                    <th class="text-center">Duración</th>
                                                    <th class="text-center">Valoración</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in presentaciones" :key="index">
                                                    <td class="text-center">{{item.fec}}</td>
                                                    <td class="text-center">{{item.nombre}}</td>
                                                    <td class="text-center">{{item.lugar}}</td>
                                                    <td class="text-center">{{item.hora_i}}</td>
                                                    <td class="text-center">{{item.durac}}</td>
                                                    <td class="text-center">{{item.valor}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+club+'/presentaciones/'+item.fec+'/'+item.obra+'/'+item.idlugar+'/edit'" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar la presentación
                                                                </div>
                                                                <div>
                                                                    <code>{{item.nombre}} en {{item.fec}} ubicada en {{item.lugar}}</code>
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
            presentaciones: [],
            club: null,
        }
    },

    created(){
        this.club = window.location.pathname;
        this.club = this.club.replace(/\D/g, '');

        axios.get(`/clubs/${this.club}/presentaciones`)
            .then(res => {
                this.presentaciones = res.data.data;
                console.log(this.presentaciones);
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {

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
            axios.delete(`/clubs/${this.club}/presentaciones/${item.fec}/${item.obra}/${item.idlugar}`)
                .then(res => {
                    window.location = `/clubs/${this.club}/presentaciones`;
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>
