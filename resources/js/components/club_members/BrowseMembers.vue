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
                                    <h4 class="card-title">Miembros del club</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link href="/managemembers/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Añadir nuevo miembro
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
                                                <tr>
                                                    <td class="text-center">123456789101112</td>
                                                    <td class="text-center">Frank</td>
                                                    <td class="text-center">Hesse</td>
                                                    <td class="text-center">{{fec_nac}}</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" @click="verifyAge(fec_nac); showModal();" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                        <b-link href="/managemembers/1/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
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

    <b-modal ref="view-member" size="lg" id="view-member" ok-variant="default" ok-only ok-title="Continuar">
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


</div>
</template>

<script>
export default {
    data(){
        return{
            fec_nac: '01-03-1999',
            mayoredad: false,

            member: {},
        }
    },

    created(){
            var path = window.location.pathname;
            var isbn = path.indexOf("/clubs", 0) + 7;
            var isbnend = path.indexOf("/members", 0);
            var id = path.substring(isbn, isbnend);
            id = parseInt(id, 10);
            var newpath = path.substring(isbnend, path.length);
            newpath = newpath.replace(/\D/g, '');
            var ide = parseInt(newpath, 10);

            console.log('id club '+id+' id group '+ide );  
    },
    
    methods:{
        showModal() {
            this.$refs['view-member'].show()
        },
    }
}
</script>

<style>

</style>
