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
                                    <h4 class="card-title">Editar pago {{this.idpay}} para {{this.member.nom1}} {{this.member.ape1}}</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <b-form @submit.prevent="update">
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
            idpay: null,
        }
    },

    created() {
        var path = window.location.pathname;
        let beginc = path.indexOf("bs")+3;
        let endc = path.indexOf("mem")-1;

        let idclub = path.substring(beginc,endc);

        let path2 = path.substring(endc,path.length);

        let beginm = path.indexOf("ers")+4;
        let endm = path.indexOf("pay")-1;

        let idmember = path.substring(beginm,endm);

        let beginp = path.indexOf("nts")+4;
        let endp = path.indexOf("edit")-1;

        let idpay = path.substring(beginp,endp);
        this.club = idclub;
        this.idmember = idmember;
        this.idpay = idpay;

        axios.get(`/clubs/${idclub}/members/${idmember}/payments/${idpay}/edit`)
            .then(res => {
                console.log(res.data);
                this.member = res.data.data;
                this.date = res.data.pago.fec_emi;
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
        update() {
            var path = window.location.pathname;
            let beginc = path.indexOf("bs")+3;
            let endc = path.indexOf("mem")-1;

            let idclub = path.substring(beginc,endc);

            let path2 = path.substring(endc,path.length);

            let beginm = path.indexOf("ers")+4;
            let endm = path.indexOf("pay")-1;

            let idmember = path.substring(beginm,endm);

            let beginp = path.indexOf("nts")+4;
            let endp = path.indexOf("edit")-1;

            let idpay = path.substring(beginp,endp);
            this.club = idclub;
            this.idmember = idmember;
            this.idpay = idpay;

            const params = {
                date: this.date,
                club: this.club,
                member: this.idmember,
            };

            console.log(params);

            axios.put(`/clubs/${idclub}/members/${idmember}/payments/${idpay}`, params)
                .then(res => {
                    console.log(res.data);
                    //window.location = `/clubs/${id}/members/${ide}/payments`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate(){
            let msg = '';
            /* MEMBER */
            if (!this.validateF) msg = msg + "El campo Fecha de Emisión no puede estar vacío\n";

            if (msg == ''){
                this.update();
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
