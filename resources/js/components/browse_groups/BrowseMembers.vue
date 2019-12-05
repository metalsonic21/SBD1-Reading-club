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

                                    <button class="btn btn-default float-right mt-3" v-b-modal.add-member>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir nuevo miembro
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
                                                    <th class="text-center">Documento de identidad</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Apellido</th>
                                                    <th class="text-center">Fecha de nacimiento</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">123456789101112</td>
                                                    <td class="text-center">Frank</td>
                                                    <td class="text-center">Hesse</td>
                                                    <td class="text-center">01-03-1999</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-member>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <b-link type="button" href="/managemembersg/1/edit" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
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

    <create-group-member></create-group-member>

    <b-modal size="lg" id="view-member" ok-variant="default" ok-only ok-title="Continuar">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">Detalles de miembro</h4>
            </div>
            <div class="card-body ">

                <b-row>
                    <b-col cols="8">
                        <p><strong>DOCUMENTO DE IDENTIDAD:</strong> 123456789101112131415</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>PRIMER NOMBRE:</strong> Frank</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>SEGUNDO NOMBRE: </strong></p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>PRIMER APELLIDO: </strong>Hesse</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>SEGUNDO APELLIDO: </strong></p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="5">
                        <p><strong>FECHA DE NACIMIENTO: </strong>{{fec_nac}}</p>
                    </b-col>

                    <b-col cols="3">
                        <p><strong>GÉNERO: </strong>Masculino</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>TELÉFONO: </strong>1234567891011</p>
                    </b-col>
                </b-row>
                <hr>
                <b-row>
                    <b-col cols="4">
                        <h6> <strong>DIRECCIÓN</strong></h6>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="4">
                        <p><strong>PAÍS:</strong> Alemania</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CIUDAD:</strong> Dresden</p>
                    </b-col>
                    <b-col cols="4">
                        <p><strong>CALLE:</strong> Something</p>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="4">
                        <p><strong>URBANIZACIÓN:</strong> Something2</p>
                    </b-col>

                    <b-col cols="4">
                        <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                    </b-col>
                </b-row>
                <hr>
                <div id="datos_rep" v-if="mayoredad == false">
                    <b-row>
                        <b-col cols="6">
                            <h6><strong>DATOS DE REPRESENTANTE</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="8">
                            <p><strong>DOCUMENTO DE IDENTIDAD:</strong> 123456789101112131415</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>PRIMER NOMBRE:</strong> Frank</p>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <p><strong>SEGUNDO NOMBRE: </strong></p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>PRIMER APELLIDO: </strong>Hesse</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>SEGUNDO APELLIDO: </strong></p>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="5">
                            <p><strong>FECHA DE NACIMIENTO: </strong>01-08-1999</p>
                        </b-col>

                        <b-col cols="3">
                            <p><strong>GÉNERO: </strong>Masculino</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>TELÉFONO: </strong>1234567891011</p>
                        </b-col>
                    </b-row>
                    <hr>
                    <b-row>
                        <b-col cols="4">
                            <h6> <strong>DIRECCIÓN</strong></h6>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">
                            <p><strong>PAÍS:</strong> Alemania</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CIUDAD:</strong> Dresden</p>
                        </b-col>
                        <b-col cols="4">
                            <p><strong>CALLE:</strong> Something</p>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="4">
                            <p><strong>URBANIZACIÓN:</strong> Something2</p>
                        </b-col>

                        <b-col cols="4">
                            <p><strong>CÓDIGO POSTAL:</strong> 676767</p>
                        </b-col>
                    </b-row>
                </div>

            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="edit-member" ok-variant="default" cancel-variant="danger" ok-title="Modificar" cancel-title="Cancelar">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">edit</i>
                </div>
                <h4 class="card-title">Modificar miembro</h4>
            </div>
            <div class="card-body ">
                <b-form>

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
            fec_nac: '01-03-1999',
            mayoredad: false,
        }
    },

    methods: {
        verifyAge(memberAge) {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            var today = yyyy + '-' + mm + '-' + dd;
            var todaydate = new Date(today);
            var agedate = new Date(memberAge);
            var verif = todaydate.valueOf() - agedate.valueOf();
            var edad = verif / (1000 * 60 * 60 * 24);
            edad = Math.trunc(edad / 365);

            if (edad < 18) {
                this.mayoredad = false;
            } else if (edad <= 18) {
                this.mayoredad = true;
            }
            console.log(this.mayoredad);
            return this.mayoredad;
        },
        showModal() {
            this.$refs['view-member'].show()
        },
    }
}
</script>

<style>

</style>
