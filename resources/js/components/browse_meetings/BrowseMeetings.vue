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
                                <div class="col-lg-5">
                                    <h4 class="card-title">Reuniones para el grupo</h4>
                                </div>
                                <div class="col-lg-7">
                                    <b-link v-bind:href="'/managemeetings/calendar'" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">calendar_today</i>
                                        </span>
                                        Consultar calendario
                                    </b-link>

                                    <b-link @click="verify" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir reunión
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
                                                    <th class="text-center">Libro</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Moderador</th>
                                                    <th class="text-center">Sesión</th>
                                                    <th class="text-center">Valoración</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in meetings" :key="index">
                                                    <td class="text-center">{{item.libro}}</td>
                                                    <td class="text-center">{{item.fecha}}</td>
                                                    <td class="text-center">{{item.moderador}}</td>
                                                    <td class="text-center">{{item.sesion}}</td>
                                                    <td class="text-center">{{item.valoracion}}</td>
                                                    <td class="td-actions text-center">
                                                        <b-link v-bind:href="'/clubs/'+club+'/groups/'+grupo+'/meetings/'+item.fecha+'/'+item.idmod+'/'+item.idlibro+'/'+item.sesion+'/details'" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link @click="verifyA(item)" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Control de asistencia para esta reunión" class="btn btn-default" v-b-modal.attendance>
                                                            <i class="material-icons">list</i>
                                                        </b-link>
                                                        <b-link v-bind:href="'/clubs/'+club+'/groups/'+grupo+'/meetings/'+item.fecha+'/'+item.idmod+'/'+item.idlibro+'/edit'" rel="tooltip" data-toggle="tooltip" v-b-modal.add-meeting data-placement="bottom" title="Modificar reunión" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <b-button class="btn btn-danger" id="show-btn" @click="showModal(index)"><i class="material-icons" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Retirar">close</i>
                                                        </b-button>
                                                        <b-modal v-bind:id="index.toString()" hide-footer>
                                                            <template v-slot:modal-title>
                                                                <div>
                                                                    Está apunto de eliminar la reunión sobre
                                                                </div>
                                                                <div>
                                                                    <code>{{item.libro}} (sesión {{item.sesion}})</code>
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
            meetings: [],
            club: null,
            grupo: null,
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

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/meetings`)
            .then(res => {
                this.meetings = res.data.data;
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
            console.log(item);
            axios.delete(`/clubs/${this.club}/groups/${this.grupo}/meetings/${item.fecha}`)
                .then(res => {
                    console.log(res.data);
                    window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings`;
                }).catch(e => {
                    console.log(e);
                })
        },
        verify() {
            axios.get(`/clubs/${this.club}/groups/${this.grupo}/verifyM`)
                .then(res => {
                    if (res.data == 1) {
                        window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings/create`;
                    } else if (res.data == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se puede programar ninguna reunión para este grupo debido a que tiene menos de 10 miembros',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    } else if (res.data == 2) {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se puede programar ninguna reunión para este grupo debido a que tiene menos de 5 miembros',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    } else if (res.data == 3) {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se puede programar ninguna reunión para este grupo debido a que tiene menos de 7 miembros',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    }
                }).catch(e => {
                    console.log(e);
                })
        },

        /* Verificar si ya la asistencia fue pasada contando el numero de inasistencia que hay en la reunion */
        verifyA(item){
            axios.get(`/clubs/${this.club}/groups/${this.grupo}/meetings/${item.fecha}/${item.idmod}/${item.idlibro}/verify`)
                .then(res => {
                    console.log(res.data);
                    if (res.data == 0) {
                        window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings/${item.fecha}/${item.idmod}/${item.idlibro}/attendance`;
                    } else if (res.data != 0) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ya usted pasó asistencia para esta reunión',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#8C7F7F',
                        })
                    } 
                }).catch(e => {
                    console.log(e);
                })
        }
    },
}
</script>

<style>

</style>
