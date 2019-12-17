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
                                    <h4 class="card-title">Personajes</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link v-bind:href="'/obras/'+obra+'/personajes/create'" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear personaje
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
                                                    <th class="text-center">Descripcion</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,index) in personajes" :key="index">
                                                    <td class="text-center">{{item.nom}}</td>
                                                    <td class="text-center">{{item.descrip}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/obras/'+obra+'/personajes/'+item.id+'/edit'" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar al personaje 
                                                                </div>
                                                                <div>
                                                                    <code>{{item.nom}}</code>
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
            personajes: [],
            obra: null,
        }
    },

    created(){
        this.obra = window.location.pathname;
        this.obra = this.obra.replace(/\D/g, '');

        axios.get(`/obras/${this.obra}/personajes`)
            .then(res => {
                this.personajes = res.data.data;
                console.log(this.personajes);
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
            axios.delete(`/obras/${this.obra}/personajes/${item.id}`)
                .then(res => {
                    console.log(res.data);
                    window.location = `/obras/${this.obra}/personajes`;
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>
