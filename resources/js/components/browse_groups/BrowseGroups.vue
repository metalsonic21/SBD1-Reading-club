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
                                    <h4 class="card-title">Explorar grupos de lectura</h4>
                                </div>
                                <div class="col-lg-2">

                                    <button class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear grupo de lectura
                                    </button>
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
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Día disponible</th>
                                                    <th class="text-center">Horario disponible</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Acheron River</td>
                                                    <td class="text-center">Lunes</td>
                                                    <td class="text-center">9:00 AM - 11:00 AM</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-group>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Añadir miembro" v-b-modal.add-member class="btn btn-default">
                                                            <i class="material-icons">person_add</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" v-b-modal.edit-group class="btn btn-success">
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

    <b-modal size="lg" id="add-group" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">Añadir nuevo grupo</h4>
            </div>
            <div class="card-body ">
                <b-form>
                    <b-row>
                        <b-col cols="6">
                            <label for="nom">Nombre</label>
                            <b-form-input type="text" v-model="nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                        </b-col>

                        <b-col cols="6">
                            <label for="club">Club Asociado</label>
                            <b-form-select v-model="club" :options="clubes" id="club" name="club"></b-form-select>
                        </b-col>
                    </b-row>
                    <hr>
                    <b-row>
                        <b-col cols="6">
                            <h6><strong>DISPONIBILIDAD</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="6">
                            <label for="dia">Día</label>
                            <b-form-select v-model="dia" :options="dias" id="dia" name="dia"></b-form-select>
                        </b-col>

                        <b-col cols="6">
                            <label for="horai">Hora Inicio</label>
                            <b-form-input type="time" v-model="horai" id="horai" name="horai"></b-form-input>
                        </b-col>
                    </b-row>
                </b-form>
            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="view-group" ok-variant="default" cancel-variant="danger" ok-title="Añadir miembro a este grupo" cancel-title="Cerrar">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">Detalles de grupo</h4>
            </div>
            <div class="card-body ">
                <b-row>
                    <b-col cols="3">
                        <p><strong>NOMBRE: </strong>Acheron River</p>
                    </b-col>

                    <b-col cols="5">
                        <p><strong>CLUB: </strong>Killer Bees</p>
                    </b-col>
                    <hr>
                </b-row>
                <hr>

                <b-row>
                    <b-col cols="6">
                        <h6><strong>DISPONIBILIDAD</strong></h6>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="4">
                        <p><strong>DÍA: </strong>Lunes</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>HORA INICIO: </strong>9:00 AM</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>HORA FIN: </strong>11:00 AM</p>
                    </b-col>
                </b-row>
            </div>
        </div>
    </b-modal>

    <create-group-member></create-group-member>

    <b-modal size="lg" id="edit-group" ok-variant="default" cancel-variant="danger" ok-title="Modificar" cancel-title="Cancelar">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Modificar grupo</h4>
            </div>
            <div class="card-body ">
                <b-form>
                    <b-row>
                        <b-col cols="6">
                            <label for="nom">Nombre</label>
                            <b-form-input type="text" v-model="nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                        </b-col>

                        <b-col cols="6">
                            <label for="club">Club Asociado</label>
                            <b-form-select v-model="club" :options="clubes" id="club" name="club"></b-form-select>
                        </b-col>
                    </b-row>
                    <hr>
                    <b-row>
                        <b-col cols="6">
                            <h6><strong>DISPONIBILIDAD</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <label for="dia">Día</label>
                            <b-form-select v-model="dia" :options="dias" id="dia" name="dia"></b-form-select>
                        </b-col>

                        <b-col cols="4">
                            <label for="horai">Hora Inicio</label>
                            <b-form-input type="time" v-model="horai" id="horai" name="horai"></b-form-input>
                        </b-col>

                        <b-col cols="4">
                            <label for="horaf">Hora Fin</label>
                            <b-form-input type="time" v-model="horaf" id="horaf" name="horaf"></b-form-input>
                        </b-col>
                    </b-row>
                </b-form>

            </div>
        </div>
    </b-modal>

</div>
</template>

<script>
export default {
    data() {
        return {
            nom: null,
            club: null,
            clubes: [{
                value: null,
                text: 'Seleccionar'
            }],
            dia: null,
            dias: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 'L',
                    text: 'Lunes'
                },
                {
                    value: 'M',
                    text: 'Martes'
                },
                {
                    value: 'Mi',
                    text: 'Miércoles'
                },
                {
                    value: 'J',
                    text: 'Jueves'
                },
                {
                    value: 'V',
                    text: 'Viernes'
                }
            ],
            horai: null,
            horaf: null,
        }
    }
}
</script>

<style>

</style>
