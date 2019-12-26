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
                                <div class="col-lg-4">
                                    <h4 class="card-title">Explorar locales para club</h4>
                                </div>
                                <div class="col-lg-8">

                                    <b-link v-bind:href="'/clubs/'+id+'/locales/create'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear local
                                    </b-link>

                                    <b-link v-bind:href="'/browseclubs'" class="btn btn-danger float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">keyboard_backspace</i>
                                        </span>
                                        Explorar clubes
                                    </b-link>

                                    <b-link v-bind:href="'/clubs/'+id+'/presentaciones/create'" class="btn btn-success float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">camera_roll</i>
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
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Capacidad</th>
                                                    <th class="text-center">Calle</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,index) in locales" :key="index">
                                                    <td class="text-center">{{item.nom}}</td>
                                                    <td class="text-center" v-if="item.tipo == 'S'">Sala</td>
                                                    <td class="text-center" v-if="item.tipo == 'A'">Auditorio</td>
                                                    <td class="text-center">{{item.cap}}</td>
                                                    <td class="text-center">{{item.direccion}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+item.id_club+'/locales/'+item.id+'/edit'" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
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
    data(){
        return{
            id: null,
            locales: [],
        }
    },

    created(){
        this.id = window.location.pathname;
        this.id = this.id.replace(/\D/g, '');
        axios.get(`/clubs/${this.id}/locales`)
            .then(res => {
                this.locales = res.data.data;

            }).catch(e => {
                console.log(e);
            })
    },
    methods:{
        showModal(item) {
            item = item.toString();
            this.$bvModal.show(item);
        },
        hideModal(item) {
            item = item.toString();
            this.$bvModal.hide(item);
        },
        borrar(item){
            axios.delete(`/clubs/${item.id_club}/locales/${item.id}`)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${item.id_club}/locales/`
                }).catch(e => {
                    console.log(e);
                })
        }
    },
    computed:{

    },

}
</script>

<style>

</style>
