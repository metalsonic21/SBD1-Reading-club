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

                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <b-button variant="default" @click="pdf(member.doc_iden)">Continuar</b-button>
                                    </div>
                                                    



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
        axios.get(`/clubs-reports-members/${this.club}`)
            .then(res => {
                this.members = res.data.members;
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {
        pdf(id) {       
            var dir = window.location.pathname;     
            this.club = parseInt(dir.replace(/\D/g, ''));
            
            const met ={
                miembro:id,
                club:this.club            
            }
            console.log(this.club);
            axios.post(`/clubs-reports-members/generate`,met)
                .then(res =>{
                    window.location = `/club-books-reports/${met.miembro}/${this.club}`;
                }).catch(e=>{
                    console.log(e)
                })
        },
    }
}
</script>
