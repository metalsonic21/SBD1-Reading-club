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
                                    <h4 class="card-title">Añadir club de lectura</h4>
                                </div>
                                <div class="col-lg-2">

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
                                                <b-form-input v-model="club.nom" type="text" id="nom" name="nom" placeholder="Nombre de club"></b-form-input>
                                                <b-form-invalid-feedback :state="validateNom">Debe rellenar el campo Nombre</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="idioma">Idioma</label>
                                                <b-form-select v-model="club.id_idiom" :options="idiomas"></b-form-select>
                                                <b-form-invalid-feedback :state="validateIdiom">Debe selecionar un idioma</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="pais">País</label>
                                                <b-form-select v-model="dir.pais" id="pais" name="pais" :options="paises" @change="filter(dir.pais, dir.ciudad); inst.pais = dir.pais"></b-form-select>
                                                <b-form-invalid-feedback :state="validatePais">Debe selecionar un pais</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ciudad">Ciudad</label>
                                                <b-form-select v-model="dir.ciudad" id="ciudad" name="ciudad" :options="ciudades"></b-form-select>
                                                <b-form-invalid-feedback :state="validateCiu">Debe selecionar una ciudad</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="4">
                                                <label for="urbanizacion">Urbanización</label>
                                                <b-form-input v-model="dir.urb" id="urbanizacion" name="urbanizacion" placeholder="Urbanización"></b-form-input>
                                                <b-form-invalid-feedback :state="validateUrb">Debe rellenar el campo urbanización</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="calle">Calle</label>
                                                <b-form-input v-model="dir.calle" id="calle" name="calle" placeholder="Calle"></b-form-input>
                                                <b-form-invalid-feedback :state="validateCalle">Debe rellenar el campo calle</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="zipcode">Código postal</label>
                                                <b-form-input v-model="dir.cod_post" id="zipcode" name="zipcode" placeholder="Código postal"></b-form-input>
                                                <b-form-invalid-feedback :state="validateZ">El campo Código Postal debe ser numérico, de no más de 7 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                        </b-row>
                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <b-form-group>
                                                    <label>¿Está asociado este club a alguna institución?</label>
                                                    <b-radio-group v-model="institucion" :options="[{text: 'Sí', value:true}, {text: 'No', value: false}]" @change="checkamount()"></b-radio-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>
                                        <div v-if="institucion">
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="inom">Nombre</label>
                                                    <b-form-input type="text" v-model="inst.nom" id="inom" name="inom" placeholder="Nombre">Nombre</b-form-input>
                                                    <b-form-invalid-feedback :state="validateInom">Debe rellenar el campo Nombre de Institucion</b-form-invalid-feedback>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="">Tipo</label>
                                                    <b-form-select v-model="inst.tipo" id="tipo" name="tipo" :options="tiposinst"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateItipo">Debe seleccionar un Tipo de Institucion</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <br>

                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="pais">País</label>
                                                    <b-form-select v-model="inst.pais" disabled id="paisI" name="paisI" :options="paises"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateIpais">Debe selecionar un pais para el Club</b-form-invalid-feedback>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ciudad">Ciudad</label>
                                                    <b-form-select v-model="inst.ciudad" id="ciudadI" name="ciudadI" :options="ciudades"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateIciu">Debe selecionar una ciudad para la Institucion</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <br>
                                        </div>

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
            club: {
                nom: null,
                id_idiom: null,
            },

            dir: {
                pais: null,
                ciudad: null,
                urb: null,
                calle: null,
                cod_post: null,
            },

            inst: {
                nom: null,
                tipo: null,
                ciudad: null,
                pais: null,
            },

            tiposinst: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 'A',
                    text: 'Academico'
                },
                {
                    value: 'E',
                    text: 'Estatal'
                },
                {
                    value: 'C',
                    text: 'Cultural'
                },
                {
                    value: 'O',
                    text: 'ONG'
                },
                {
                    value: 'O',
                    text: 'Otro'
                }
            ],

            idiomas: [{
                value: null,
                text: 'Seleccionar',
            }],

            institucion: false,

            paises: [{
                value: null,
                text: 'Seleccionar',
            }],

            ciudades: [{
                value: null,
                text: 'Seleccionar',
            }],

            ciudadesfiltered: [{}],
            ciudadesbackup: [{
                value: null,
                text: 'Seleccionar'
            }],

        }
    },

    created() {

        axios.get('/browseclubs/create')
            .then(res => {
                this.idiomas = res.data.languages;
                this.paises = res.data.countries;
                this.ciudadesbackup = res.data.cities;

            }).catch(e => {
                console.log(e);
            })
    },
    computed: {

        //Validations
        validateNom() {
            if (this.club.nom == null || this.club.nom == '') return null;
            if (this.club.nom.length > 20) return false;
            else return true;
        },
        validateIdiom() {
            return (this.club.id_idiom != null);
        },
        validatePais() {
            return (this.dir.pais != null);
        },
        validateCiu() {
            return (this.dir.ciudad != null);
        },
        validateUrb() {
            if (this.dir.urb == null || this.dir.urb == '') return null;
            if (this.dir.urb.length > 20) return false;
            else return true;
        },
        validateCalle() {
            if (this.dir.calle == null || this.dir.calle == '') return null;
            if (this.dir.calle.length > 20) return false;
            else return true;
        },
        validateInom() {
            if (this.institucion == true) {
                if (this.inst.nom != null && this.inst.nom != '' && this.inst.nom.length < 20) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        },
        validateItipo() {
            if (this.institucion == true) {
                if (this.inst.tipo != null) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        },
        validateIpais() {
            if (this.institucion == true) {
                this.inst.pais = this.dir.pais;
                if (this.inst.pais != null) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        },
        validateIciu() {
            if (this.institucion == true) {
                if (this.inst.ciudad != null) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        },
        validateZ(){
            let verif = true;
                if (this.dir.cod_post == null || this.dir.cod_post == '') return null;
                if (!isNaN(this.dir.cod_post) && this.dir.cod_post.toString().indexOf(".") == -1 && this.dir.cod_post>0 && this.dir.cod_post<9999999)
                return true;
                else return false;
        },

    },
    methods: {
        convert(id, length) {

            let pos = id.indexOf("-");
            let res = id.substring(pos + 1, length);
            parseInt(res, 10);
            return res;
        },

        filter(currentcountry, currentcity) {
            /* Filter cities according to the country*/

            this.ciudades = [{}],
                this.ciudadesfiltered = [{}],
                currentcity = null,
                this.ciudades = this.ciudadesbackup;

            let i = 0;

            for (i = 0; i < this.ciudades.length; i++) {
                /* Converted ID is id_sub*/
                let convertedid = this.convert(this.ciudades[i].value, this.ciudades.length);
                if (currentcountry == convertedid) {
                    let actualid = this.ciudades[i].value.substring(0, this.ciudades[i].value.indexOf("-"));
                    actualid = parseInt(actualid, 10);
                    this.ciudadesfiltered.push({
                        value: actualid,
                        text: this.ciudades[i].text
                    });
                }
            }

            this.ciudades = [{}];
            this.ciudades = this.ciudadesfiltered;

            this.ciudades[0].value = null;
            this.ciudades[0].text = 'Seleccionar';
        },

        revalidate() {
            let msg = '';
            let isValid = true;

            if (this.validateNom == null) msg = msg + "Debe rellenar el campo Nombre del Club<br>";
            if (this.validateNom == false) msg = msg + "El campo Nombre del Club no debe tener más de 20 caracteres<br>"
            if (this.validateIdiom == false) msg = msg + "Debe selecionar un idioma<br>";
            if (this.validatePais == false) msg = msg + "Debe selecionar un pais<br>";
            if (this.validateCiu == false) msg = msg + "Debe selecionar una ciudad<br>";
            if (this.validateUrb == null) msg = msg + "Debe rellenar el campo Urbanización<br>";
            if (this.validateUrb == false) msg = msg + "El campo Urbanización no puede tener más de 20 caracteres<br>";
            if (this.validateCalle == null) msg = msg + "Debe rellenar el campo Calle<br>";
            if (this.validateCalle == false) msg = msg + "El campo Calle no puede tener más de 20 caracteres<br>";
            if (this.validateInom == null) msg = msg + "Debe rellenar el campo Nombre de Institución<br>";
            if (this.validateInom == false) msg = msg + "El campo Nombre de Institución no debe tener más de 20 caracteres<br>";
            if (this.validateItipo == false) msg = msg + "Debe seleccionar un Tipo de Institución<br>";
            if (this.validateIpais == false) msg = msg + "Debe selecionar un pais para la Institución<br>";
            if (this.validateIciu == false) msg = msg + "Debe selecionar una ciudad para la Institución<br>";
            if (this.validateZ == false) msg = msg + "El campo Código Postal debe ser un número de no más de 7 caracteres<br>"

            if (msg != '') {
                isValid = false;
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-left">'+msg+'</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            } else {
                this.add();
            }
        },
        add() {
            if (!this.institucion) {
                this.inst.nom = false;
            }

            const params = {

                nom: this.club.nom,
                id_idiom: this.club.id_idiom,

                calle: this.dir.calle,
                ciudad: this.dir.ciudad,
                urb: this.dir.urb,
                cod_post: this.dir.cod_post,

                nom_inst: this.inst.nom,
                tipo_inst: this.inst.tipo,
                ciudad_inst: this.inst.ciudad,
            }

            //Clear 
            this.club.nom = '';
            this.club.in_dir = '';
            this.club.id_idiom = '';
            this.club.id_inst = '';

            console.log(params);

            axios.post('/browseclubs', params)
                .then(res => {
                    window.location = "/browseclubs";
                }).catch(e => {
                    console.log(e);
                })
        }
    }
}
</script>

<style>

</style>
