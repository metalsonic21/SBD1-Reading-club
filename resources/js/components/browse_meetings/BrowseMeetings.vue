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

                                    <b-link v-bind:href="'/clubs/'+club+'/groups/'+grupo+'/meetings/create'" class="btn btn-default float-right mt-3">
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
                                    <div class="table-responsive table-sales">
                                        <table class="table" >
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
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.meeting-details>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Control de asistencia para esta reunión" class="btn btn-default" v-b-modal.attendance>
                                                            <i class="material-icons">list</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" v-b-modal.add-meeting data-placement="bottom" title="Modificar reunión" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
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
    <meeting-attendance></meeting-attendance>
    <meeting-details></meeting-details>
</div>
</template>

<script>
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

    },
}
</script>

<style>

</style>
