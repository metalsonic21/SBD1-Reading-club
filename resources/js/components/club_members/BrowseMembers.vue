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
                                    <h4 class="card-title">Miembros del club</h4>
                                </div>
                                <div class="col-lg-8">

                                    <b-link v-bind:href="'/clubs/'+club+'/members/create'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir nuevo miembro
                                    </b-link>

                                    <b-link v-bind:href="'/clubs/'+club+'/freeagent'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">account_box</i>
                                        </span>
                                        Añadir agente libre
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="material-datatables">
                                        <table class="table table-sales table-hover table-no-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Documento de identidad</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Apellido</th>
                                                    <th class="text-center">Fecha de nacimiento</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(member,index) in members" :key="index">
                                                    <td class="text-center">{{member.doc_iden}}</td>
                                                    <td class="text-center">{{member.nom}}</td>
                                                    <td class="text-center">{{member.ape}}</td>
                                                    <td class="text-center">{{member.fec_nac}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+club+'/members/'+member.doc_iden" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link v-bind:href="'/clubs/'+club+'/members/'+member.doc_iden+'/edit'" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar al miembro
                                                                </div>
                                                                <div>
                                                                    <code>{{member.nom}} {{member.ape}}</code>
                                                                </div>
                                                            </template>
                                                            <div>
                                                                <b-button class="btn btn-danger btn-block" @click="borrar(member)">Eliminar</b-button>
                                                            </div>
                                                            <b-button class="mt-3" block @click="hideModal(index)">Cancelar</b-button>
                                                        </b-modal>

                                                        <b-link @click="allow(member)" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Control de pagos" class="btn btn-warning">
                                                            <i class="material-icons">euro</i>
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
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            members: [],
            club: null,
        }
    },
    created() {
        var params = window.location.pathname;
        this.club = params.replace(/\D/g, '');

        axios.get(`/clubs/${this.club}/members`)
            .then(res => {
                this.members = res.data.members;
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
            const params = {
                trash: 1,
            };
            axios.put(`/clubs/${this.club}/deletemember/${item.doc_iden}`, params)
                .then(res => {
                    window.location = `/clubs/${this.club}/members`;
                }).catch(e => {
                    console.log(e);
                })
        },

        allow(item) {
            axios.get(`/clubs/${this.club}/members/${item.doc_iden}/canAddPayment`)
                .then(res => {
                    //console.log(res.data);
                    if (res.data == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Este club está asociado a una institución, no hay pagos para consultar',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    }
                    else {
                        window.location = `/clubs/${this.club}/members/${item.doc_iden}/payments`;
                    }
                    
                }).catch(e => {
                    console.log(e);
                })
        }

    }
}
</script>
