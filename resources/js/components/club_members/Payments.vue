<template>
    <div>
        
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">euro</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                <h4 class="card-title">Control de pagos para {{member.nom1}} {{member.ape1}}</h4>
                                </div>
                                <div class="col-lg-5">

                                <b-link v-bind:href="'/clubs/'+club+'/members/'+member.doc_iden+'/payments/create'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Registrar nuevo pago
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
                                                    <th class="text-center">Código</th>
                                                    <th class="text-center">Fecha de emisión de pago</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(pago,index) in pagos" :key="index">
                                                    <td class="text-center">{{pago.id}}</td>
                                                    <td class="text-center">{{pago.fechapago}}</td>
                                                        <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+club+'/members/'+member.doc_iden+'/payments/'+pago.id+'/edit'" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar el pago
                                                                </div>
                                                                <div>
                                                                    <code>{{pago.id}} hecho en {{pago.fechapago}}</code>
                                                                </div>
                                                            </template>
                                                            <div>
                                                                <b-button class="btn btn-danger btn-block" @click="borrar(pago)">Eliminar</b-button>
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
    data(){
        return{
            pagos:[],
            club: null,
            idmember: null,
            member: {},
        }
    },
    created(){
        var path = window.location.pathname;
        var isbn = path.indexOf("/clubs", 0) + 7;
        var isbnend = path.indexOf("/members", 0);
        var id = path.substring(isbn, isbnend);
        this.club = parseInt(id, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        this.idmember = parseInt(newpath, 10);

        axios.get(`/clubs/${this.club}/members/${this.idmember}/payments`)
            .then(res => {
                this.member = res.data.member;
                this.pagos = res.data.pagos;
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
        borrar(item) {
            axios.delete(`/clubs/${this.club}/members/${this.idmember}/payments/${item.id}`)
                .then(res => {
                    window.location = `/clubs/${this.club}/members/${this.idmember}/payments`;
                }).catch(e => {
                    console.log(e);
                })
        },
    },
}
</script>