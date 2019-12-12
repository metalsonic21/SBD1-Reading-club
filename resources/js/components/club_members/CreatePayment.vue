<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Registrar pago para {{this.member.nom1}} {{this.member.ape1}}</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="">Fecha de emisión</label>
                                                <b-form-input type="date" v-model="date" id="date" name="date"></b-form-input>
                                                <b-form-invalid-feedback :state="validateF">La fecha de emisión no puede estar vacía</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="revalidate">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/managemembers">Cancelar</b-link>
                                        </div>
                                        
                                    </b-form>
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
            member: {},
            date: null,
            club: null,
            idmember: null,
        }
    },

    created() {
        var path = window.location.pathname;
        var isbn = path.indexOf("/clubs", 0) + 7;
        var isbnend = path.indexOf("/members", 0);
        var id = path.substring(isbn, isbnend);
        id = parseInt(id, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        var ide = parseInt(newpath, 10);

        this.club = id;
        this.idmember = ide;
        axios.get(`/clubs/${id}/members/${ide}/payments/create`)
            .then(res => {
                this.member = res.data.data;
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        validateF(){
            return (this.date != null);
        }
    },
    methods: {
        add() {
            var path = window.location.pathname;
            var isbn = path.indexOf("/clubs", 0) + 7;
            var isbnend = path.indexOf("/members", 0);
            var id = path.substring(isbn, isbnend);
            id = parseInt(id, 10);
            var newpath = path.substring(isbnend, path.length);
            newpath = newpath.replace(/\D/g, '');
            var ide = parseInt(newpath, 10);
            const params = {
                date: this.date,
                club: this.club,
                member: this.idmember,
            };

            console.log(params);

            axios.post(`/clubs/${id}/members/${ide}/payments`, params)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${id}/members/${ide}/payments`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate(){
            let msg = '';
            /* MEMBER */
            if (!this.validateF) msg = msg + "El campo Fecha de Emisión no puede estar vacío\n";

            if (msg == ''){
                this.add();
            }
            else{
                alert(msg);
            }
        }
    }
}
</script>

<style>

</style>
