<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">edit</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Modificar grupo</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Nombre</label>
                                                <b-form-input type="text" v-model="group.nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El nombre del grupo no puede estar vacío ni tener más de 40 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                            <b-col>
                                                <label for="tipo">Tipo</label>
                                                <b-form-select v-model="group.tipo" :options="tipos" id="tipo" name="tipo"></b-form-select>
                                                <b-form-invalid-feedback :state="validateT">* Requerido</b-form-invalid-feedback>
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
                                                <b-form-select v-model="group.dia" :options="dias" id="dia" name="dia"></b-form-select>
                                                <b-form-invalid-feedback :state="validateD">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="horai">Hora Inicio</label>
                                                <b-form-input type="time" v-model="group.horai" id="horai" name="horai"></b-form-input>
                                                <b-form-invalid-feedback :state="validateH"></b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>

                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="revalidate">Continuar</b-button>
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
</template>

<script>
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            group: {
                horai: null,
                dia: null,
                nom: null,
                tipo: null,
            },
            dias: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 2,
                    text: 'Lunes'
                },
                {
                    value: 3,
                    text: 'Martes'
                },
                {
                    value: 4,
                    text: 'Miércoles'
                },
                {
                    value: 5,
                    text: 'Jueves'
                },
                {
                    value: 6,
                    text: 'Viernes'
                }
            ],
            tipos: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 'A',
                    text: 'Grupo de Adultos'
                },
                {
                    value: 'J',
                    text: 'Grupo de Jovenes'
                },
                {
                    value: 'N',
                    text: 'Grupo de Niños'
                }
            ],
            count: 0,
        }
    },

    created() {
        var path = window.location.pathname;
        var isbn = path.indexOf("bs") + 3;
        var isbnend = path.indexOf("gr") - 1;
        var id = path.substring(isbn, isbnend);
        id = parseInt(id, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        var ide = parseInt(newpath, 10);

        axios.get(`/clubs/${id}/groups/${ide}/edit`)
            .then(res => {
                this.group = res.data.data[0];
                console.log(res.data.data);
                //this.group = res.data.data;
            }).catch(e => {
                console.log(e);
            })

    },

    computed: {
        validateN(){
            if (this.group.nom == null || this.group.nom == '')
            return null;
            if (this.group.nom.length > 40) return false;
            else return true;
        },
        validateT() {
            return (this.group.tipo != null);
        },
        validateD() {
            return (this.group.dia != null);
        },
        validateH() {
            return (this.group.horai != null);
        }
    },

    methods: {
        update() {
            const params = {
                nom: this.group.nom,
                dia: this.group.dia,
                tipo: this.group.tipo,
                horai: this.group.horai,
                count: this.count + 1,
            };

            var path = window.location.pathname;
            var isbn = path.indexOf("bs") + 3;
            var isbnend = path.indexOf("gr") - 1;
            var id = path.substring(isbn, isbnend);
            id = parseInt(id, 10);
            var newpath = path.substring(isbnend, path.length);
            newpath = newpath.replace(/\D/g, '');
            var ide = parseInt(newpath, 10);

            axios.put(`/clubs/${id}/groups/${ide}`, params)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${id}/groups`;
                }).catch(e => {
                    console.log(e);
                })

        },
        revalidate() {
            let msg = '';
                if (this.validateN == null) msg = msg + "El campo Nombre de Grupo no puede estar vacío<br>";
                if (this.validateN == false) msg = msg + "El campo Nombre de Grupo no puede tener más de 40 caracteres<br>";
                if (!this.validateT) msg = msg + "El campo Tipo de Grupo no puede estar vacío<br>";
                if (!this.validateD) msg = msg + "El campo Día de Disponibilidad no puede estar vacío<br>";
                if (!this.validateH) msg = msg + "El campo Hora Inicio no puede estar vacío<br>";

            
            if (this.group.tipo == 'N'){
                var test = this.group.horai.substring(0,2);
                if (test>17) msg = msg + "Las reuniones de niños no pueden terminar más tarde de las 7 de la noche, seleccione una hora de inicio más temprana<br>";
            }

            var test = this.group.horai.substring(0,2);
                if (test<7) msg = msg + "Las reuniones no pueden empezar antes de las 7 AM<br>";

            if (msg == '') {
                this.update();
            } else{
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-left">'+msg+'</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })

            }
        }
    }
}
</script>
