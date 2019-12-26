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
                                    <h4 class="card-title">Elenco</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link @click="castable()" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Asignar personaje a actor
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
                                                    <th class="text-center">Personaje</th>
                                                    <th class="text-center">Actor</th>
                                                    <th class="text-center">¿Es principal?</th>
                                                    <th class="text-center">¿Mejor actor?</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,index) in elenco" :key="index">
                                                    <td class="text-center">{{item.personaje}}</td>
                                                    <td class="text-center">{{item.actor}}</td>
                                                    <td class="text-center">{{item.principal}}</td>
                                                    <td class="text-center">{{item.mejor}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar el rol de
                                                                </div>
                                                                <div>
                                                                    <code>{{item.actor}} como {{item.personaje}}</code>
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
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            club: null,
            fec: null,
            obra: null,
            local: null,

            elenco: [{}],
        }
    },
    created() {
        var path = window.location.pathname;
        let beginc = path.indexOf("bs/") + 3;
        let endc = path.indexOf("/pr");

        this.club = path.substring(beginc, endc);

        let path2 = path.substring(endc + 1, path.length);
        let beginf = path2.indexOf("/") + 1;
        let endf = path2.lastIndexOf("-") + 3;

        this.fec = path2.substring(beginf, endf);

        let path3 = path2.substring(endf + 1, path2.length);

        let endl = path3.indexOf("/");
        this.obra = path3.substring(0, endl);

        let path4 = path3.substring(endl + 1, path3.length);

        this.local = path4.replace(/\D/g, '');

        //console.log('club: '+this.club+' fecha: '+this.fec+' obra: '+this.obra+' local: '+this.local);

        axios.get(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast`)
            .then(res => {
                this.elenco = res.data.elenco;
                //window.location = `/obras/${this.obra}/personajes`;
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
        castable() {
            axios.get(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/castable`)
                .then(res => {
                    console.log(res.data);
                    if (res.data > 0) {
                        window.location = `/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast/create`;
                    } else {
                        Swal.fire({
                            title: 'Error',
                            html: 'No se puede asignar una presentación a un club que no tiene miembros',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    }
                }).catch(e => {
                    console.log(e);
                })

        },
        borrar(item) {
            axios.delete(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/${item.id_lec}/${item.id_pers}`)
                .then(res => {
                    window.location = `/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast`;
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>
