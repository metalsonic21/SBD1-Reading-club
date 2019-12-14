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
                                    <h4 class="card-title">Miembros del grupo</h4>
                                </div>
                                <div class="col-lg-2">
                                    <b-link v-bind:href="'/clubs/'+club+'/groups/'+grupo+'/gmembers/create'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir miembro
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-sales">
                                        <table class="table">
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
                                                <tr v-for="(item, index) in members" :key="index">
                                                    <td class="text-center">{{item.doc_iden}}</td>
                                                    <td class="text-center">{{item.nom1}}</td>
                                                    <td class="text-center">{{item.ape1}}</td>
                                                    <td class="text-center">{{item.fec_nac}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+item.id_club+'/members/'+item.doc_iden" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-member>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar al miembro
                                                                </div>
                                                                <div>
                                                                    <code>{{item.nom1}} {{item.ape1}}</code>
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
            fec_nac: '01-03-1999',
            mayoredad: false,
            club: null,
            grupo: null,
            members: [{}],
        }
    },

    created() {
        var path = window.location.pathname;
        var isbn = path.indexOf("/clubs", 0) + 7;
        var isbnend = path.indexOf("/groups", 0);
        this.club = path.substring(isbn, isbnend);
        this.club = parseInt(this.club, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        this.grupo = parseInt(newpath, 10);

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/gmembers`)
            .then(res => {
                this.members = res.data.data;
            }).catch(e => {
                console.log(e);
            })

        //console.log('id club '+this.club+' id grupo '+this.grupo );

    },

    methods: {
        add(member) {
            axios.put(`/clubs/${member.id_club}/groups/${member.id_grup}/gmembers/${member.doc_iden}`, member)
                .then(res => {
                    console.log(res.data);
                    //window.location = `/clubs/${id}/members/`;
                }).catch(e => {
                    console.log(e);
                })
        },
        showModal(item) {
            item = item.toString();
            this.$bvModal.show(item);
        },
        hideModal(item) {
            item = item.toString();
            this.$bvModal.hide(item);
        },
        borrar(item){
            axios.put(`/clubs/${this.club}/groups/${this.grupo}/dropmember/${item.doc_iden}`, item.doc_iden)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${this.club}/groups/${this.grupo}/gmembers`;
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>

<style>

</style>
