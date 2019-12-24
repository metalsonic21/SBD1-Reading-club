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
                                    <h4 class="card-title">Añadir miembro a club</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="dociden">Documento de identidad</label>
                                                <b-form-input type="text" v-model="member.dociden" id="dociden" name="dociden" placeholder="Documento de identidad"></b-form-input>
                                                <b-form-invalid-feedback :state="validateD">El documento de identidad debe ser un número entero de 8 caracteres que no esté registrado anteriormente en la base de datos</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="nom1">Primer nombre</label>
                                                <b-form-input type="text" v-model="member.nom1" id="nom1" name="nom1" placeholder="Primer nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El nombre no debe tener más de 15 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="nom2">Segundo nombre</label>
                                                <b-form-input type="text" v-model="member.nom2" id="nom2" name="nom2" placeholder="Segundo nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateSN">El segundo nombre no debe tener más de 15 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="ape1">Primer apellido</label>
                                                <b-form-input type="text" v-model="member.ape1" name="ape1" id="ape1" placeholder="Primer apellido"></b-form-input>
                                                <b-form-invalid-feedback :state="validateA">El apellido no puede tener más de 15 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ape2">Segundo apellido</label>
                                                <b-form-input type="text" v-model="member.ape2" name="ape2" id="ape2" placeholder="Segundo apellido"></b-form-input>
                                                <b-form-invalid-feedback :state="validateSA">El segundo apellido no puede tener más de 15 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="2">
                                                <label for="genero">Género</label>
                                                <b-form-select v-model="member.genero" :options="generos" id="genero"></b-form-select>
                                                <b-form-invalid-feedback :state="validateG">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="2">
                                                <label for="fec_nac">Fecha de Nacimiento</label>
                                                <b-form-input type="date" v-model="member.fec_nac" v-on:input="mayoredad=true; verifyAge(member.fec_nac)" name="fec_nac" id="fec_nac"></b-form-input>
                                                <b-form-invalid-feedback :state="validateF">Miembro debe ser mayor de 9 años</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="2">
                                                <label for="codpais">Código de país</label>
                                                <b-form-input type="text" v-model="member.codp" name="codpais" id="codpais"></b-form-input>
                                                <b-form-invalid-feedback :state="validateCP">El código de país no puede tener más de 3 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="2">
                                                <label for="codarea">Código de área</label>
                                                <b-form-input type="text" v-model="member.coda" name="codarea" id="codarea"></b-form-input>
                                                <b-form-invalid-feedback :state="validateCODA">El código de área debe ser un valor numérico entero de no más de 5 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="num">Número telefónico</label>
                                                <b-form-input type="text" v-model="member.telefono" name="num" id="num"></b-form-input>
                                                <b-form-invalid-feedback :state="validateT">El teléfono debe ser un valor numérico entero de máximo 9 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="pais">País</label>
                                                <b-form-select v-model="member.pais" id="pais" name="pais" :options="paises" @change="filter(member.pais, member.ciudad)"></b-form-select>
                                                <b-form-invalid-feedback :state="validateP">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ciudad">Ciudad</label>
                                                <b-form-select v-model="member.ciudad" id="ciudad" name="ciudad" :options="ciudades"></b-form-select>
                                                <b-form-invalid-feedback :state="validateCI">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="4">
                                                <label for="urbanizacion">Urbanización</label>
                                                <b-form-input v-model="member.urbanizacion" id="urbanizacion" name="urbanizacion" placeholder="Urbanización"></b-form-input>
                                                <b-form-invalid-feedback :state="validateU">Campo urbanización no puede estar vacío ni tener más de 20 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="calle">Calle</label>
                                                <b-form-input v-model="member.calle" id="calle" name="calle" placeholder="Calle"></b-form-input>
                                                <b-form-invalid-feedback :state="validateCA">Campo calle no puede estar vacío ni tener más de 20 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="zipcode">Código postal</label>
                                                <b-form-input v-model="member.zipcode" id="zipcode" name="zipcode" placeholder="Código postal"></b-form-input>
                                                <b-form-invalid-feedback :state="validateZ">El código postal debe ser un campo numérico de no más de 7 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                        </b-row>
                                        <hr>
                                        <div id="datos-representante" v-if="mayoredad==false">
                                            <b-row>
                                                <b-col cols="6">
                                                    <label style="color:black">
                                                        <h6>DATOS DE REPRESENTANTE</h6>
                                                    </label>

                                                </b-col>
                                            </b-row>

                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="docidenR">Documento de identidad</label>
                                                    <b-form-input type="text" v-model="rep.dociden" id="docidenR" name="docidenR" placeholder="Documento de identidad"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateDR">El documento de identidad debe ser un número entero de 8 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="nom1R">Primer nombre</label>
                                                    <b-form-input type="text" v-model="rep.nom1" id="nom1R" name="nom1R" placeholder="Primer nombre"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateNR">El nombre no debe tener más de 15 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="nom2R">Segundo nombre</label>
                                                    <b-form-input type="text" v-model="rep.nom2" id="nom2R" name="nom2R" placeholder="Segundo nombre"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateSNR">El segundo nombre no debe tener más de 15 caracteres</b-form-invalid-feedback>

                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="ape1R">Primer apellido</label>
                                                    <b-form-input type="text" v-model="rep.ape1" name="ape1R" id="ape1R" placeholder="Primer apellido"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateAR">El apellido no puede tener más de 15 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ape2R">Segundo apellido</label>
                                                    <b-form-input type="text" v-model="rep.ape2" name="ape2R" id="ape2R" placeholder="Segundo apellido"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateSAR">El segundo apellido no puede tener más de 15 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                            </b-row>
                                            <br>
                                            <b-row>

                                                <b-col cols="6">
                                                    <label for="fec_nacR">Fecha de Nacimiento</label>
                                                    <b-form-input type="date" v-model="rep.fec_nac" name="fec_nacR" id="fec_nacR"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateFR">Representante debe ser mayor de edad</b-form-invalid-feedback>

                                                </b-col>
                                            </b-row>
                                            <hr>
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="paisR">País</label>
                                                    <b-form-select v-model="rep.pais" id="paisR" name="paisR" :options="paises" @change="filterR(rep.pais, rep.ciudad)"></b-form-select>
                                                    <b-form-invalid-feedback :state="validatePR">* Requerido</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ciudadR">Ciudad</label>
                                                    <b-form-select v-model="rep.ciudad" id="ciudadR" name="ciudadR" :options="ciudadesR"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateCIR">* Requerido</b-form-invalid-feedback>

                                                </b-col>

                                            </b-row>
                                            <br>
                                            <b-row>

                                                <b-col cols="4">
                                                    <label for="urbanizacionR">Urbanización</label>
                                                    <b-form-input v-model="rep.urbanizacion" id="urbanizacionR" name="urbanizacionR" placeholder="Urbanización"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateUR">Campo urbanización no puede tener más de 20 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="calleR">Calle</label>
                                                    <b-form-input v-model="rep.calle" id="calle" name="calleR" placeholder="Calle"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateCA">Campo calle no puede tener más de 20 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="zipcodeR">Código postal</label>
                                                    <b-form-input v-model="rep.zipcode" id="zipcodeR" name="zipcodeR" placeholder="Código postal"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateZR">El código postal debe ser un campo numérico de no más de 7 caracteres</b-form-invalid-feedback>

                                                </b-col>

                                            </b-row>

                                        </div>
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
            member: {
                dociden: null,
                nom1: null,
                nom2: null,
                ape1: null,
                ape2: null,
                genero: null,
                fec_nac: null,
                pais: null,
                ciudad: null,
                urbanizacion: null,
                calle: null,
                zipcode: null,
                coda: null,
                codp: null,
                telefono: null,
            },

            rep: [{
                dociden: '',
                nom1: '',
                nom2: '',
                ape1: '',
                ape2: '',
                genero: '',
                fec_nac: null,
                pais: null,
                ciudad: null,
                calle: '',
                urbanizacion: '',
                zipcode: '',
            }],

            generos: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 'M',
                    text: 'Masculino'
                },
                {
                    value: 'F',
                    text: 'Femenino'
                }
            ],

            paises: [{
                value: null,
                text: 'Seleccionar',
            }],
            ciudadesbackup: [{
                value: null,
                text: 'Seleccionar'
            }],
            mayoredad: true,
            ciudades: [{
                value: null,
                text: 'Seleccionar'
            }],
            ciudadesR: [{
                value: null,
                text: 'Seleccionar'
            }],
            ciudadesfiltered: [{}],
            ciudadesfilteredR: [{}],
            lectores: [{}],
            today: null,

        }
    },

    created() {
        var params = window.location.pathname;
        params = params.replace(/\D/g, '');
        //console.log(params);
        axios.get(`/clubs/${params}/members/create`)
            .then(res => {
                this.paises = res.data.countries;
                this.ciudadesbackup = res.data.cities;
                this.lectores = res.data.lectores;
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        validateD() {
            let verif = true;
            if (this.member.dociden == null || this.member.dociden == '') return null;
            if (this.member.dociden.toString().length != 8 || isNaN(this.member.dociden))
                verif = false;
            if (this.member.dociden.toString().indexOf(".") != -1 || this.member.dociden < 0)
                verif = false;
            /* Already exists*/
            let i = 0;
            for (i = 0; i < this.lectores.length; i++) {
                if (this.lectores[i].doc_iden == this.member.dociden) {
                    verif = false;
                    break;
                }
            }
            //console.log(verif);
            return verif;
        },

        validateN() {
            if (this.member.nom1 == null || this.member.nom1 == '') return null;
            if (this.member.nom1.length > 20) return false;
            else return true;
        },
        validateSN() {
            if (this.member.nom2 != null && this.member.nom2.length > 20) return false;
            else return true;
        },
        validateA() {
            if (this.member.ape1 == null || this.member.ape1 == '') return null
            if (this.member.ape1.length > 20) return false;
            else return true;
        },
        validateSA() {
            if (this.member.ape2 == null || this.member.ape2 == '') return null;
            if (this.member.ape2.length > 20) return false;
            else return true;
        },
        validateG() {
            if (this.member.genero == null) return false;
        },
        validateF() {
            if ((this.member.fec_nac) == null) return false;
            else {
                let verif = true;
                let a = Date.now();
                let b = Date.parse(this.member.fec_nac);
                if (a - b < 284012334000) return false;
                else return verif;
            }
        },
        validateCP() {
            if (this.member.codp == null || this.member.codp == '') return null;
            if (!isNaN(this.member.codp) && this.member.codp > 0 && this.member.codp < 999 && this.member.codp.toString().indexOf(".") == -1)
                return true;
            else return false;
        },
        validateCODA() {
            let verif = true;
            if (this.member.coda == null || this.member.coda == '') return null;
            if (!isNaN(this.member.coda) && this.member.coda.toString().indexOf(".") == -1 && this.member.coda > 0 && this.member.coda < 99999)
                return true;
            else return false;
        },
        validateT() {
            let verif = true;
            if (this.member.telefono == null || this.member.telefono == '') return null;
            if (!isNaN(this.member.telefono) && this.member.telefono.toString().indexOf(".") == -1 && this.member.telefono > 0 && this.member.telefono < 999999999)
                return true;
            else return false;
        },
        validateP() {
            if (this.member.pais == null) return false;
        },
        validateCI() {
            if (this.member.ciudad == null) return false;
        },
        validateU() {
            if (this.member.urbanizacion == null || this.member.urbanizacion == '') return null;
            if (this.member.urbanizacion.length > 20) return false;
            else return true;
        },
        validateCA() {
            if (this.member.calle == null || this.member.calle == '') return null;
            if (this.member.calle.length > 20) return false;
            else return true;
        },
        validateZ() {
            let verif = true;
            if (this.member.zipcode == null || this.member.zipcode == '') return null;
            if (!isNaN(this.member.zipcode) && this.member.zipcode.toString().indexOf(".") == -1 && this.member.zipcode > 0 && this.member.zipcode < 9999999)
                return true;
            else return false;
        },

        /* REPRESENTANTE */
        validateDR() {
            let verif = true;
            if (this.rep.dociden == null || this.rep.dociden == '') return null;
            if (this.rep.dociden.toString().length != 8 || isNaN(this.rep.dociden))
                verif = false;
            if (this.rep.dociden.toString().indexOf(".") != -1 || this.rep.dociden < 0)
                verif = false;
            return verif;
        },

        validateNR() {
            if (this.rep.nom1 == null || this.rep.nom1 == '') return null;
            if (this.rep.nom1.length > 20) return false;
            else return true;
        },
        validateSNR() {
            if (this.rep.nom2 != null && this.rep.nom2.length > 20) return false;
            else return true;
        },
        validateAR() {
            if (this.rep.ape1 == null || this.rep.ape1 == '') return null;
            if (this.rep.ape1.length > 20) return false;
            else return true;
        },
        validateSAR() {
            if (this.rep.ape2 == null || this.rep.ape2 == '') return null;
            if (this.rep.ape2.length > 20) return false;
            else return true;
        },
        validateGR() {
            return (this.rep.genero != null)
        },
        validateFR() {
            if ((this.rep.fec_nac) == null) return false;
            else {
                let verif = true;
                let a = Date.now();
                let b = Date.parse(this.rep.fec_nac);
                if (a - b < 568024668000) return false;
                else return verif;
            }
        },
        validatePR() {
            return (this.rep.pais != null);
        },
        validateCIR() {
            return (this.rep.ciudad != null);
        },
        validateUR() {
            if (this.rep.urbanizacion == null || this.rep.urbanizacion == '') return null;
            if (this.rep.urbanizacion.length > 20) return false;
            else return true;
        },
        validateCAR() {
            if (this.rep.calle == null || this.rep.calle == '') return null;
            if (this.rep.calle.length > 20) return false;
            else return true;
        },
        validateZR() {
            let verif = true;
            if (this.rep.zipcode == null || this.rep.zipcode == '') return null;
            if (!isNaN(this.rep.zipcode) && this.rep.zipcode.toString().indexOf(".") == -1 && this.rep.zipcode > 0 && this.rep.zipcode < 9999999)
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

        docExists() {
            /* Already exists*/
            let verif = false;
            let i = 0;
            for (i = 0; i < this.lectores.length; i++) {
                if (this.lectores[i].doc_iden == this.member.dociden) {
                    verif = true;
                    break;
                }
            }
            return verif;
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

        filterR(currentcountry, currentcity) {
            /* Filter cities according to the country*/
            this.ciudadesR = [{}],
                this.ciudadesfilteredR = [{}],
                currentcity = null,
                this.ciudadesR = this.ciudadesbackup;

            let i = 0;

            for (i = 0; i < this.ciudadesR.length; i++) {
                /* Converted ID is id_sub*/
                let convertedid = this.convert(this.ciudadesR[i].value, this.ciudadesR.length);
                if (currentcountry == convertedid) {
                    let actualid = this.ciudadesR[i].value.substring(0, this.ciudadesR[i].value.indexOf("-"));
                    actualid = parseInt(actualid, 10);
                    this.ciudadesfilteredR.push({
                        value: actualid,
                        text: this.ciudadesR[i].text
                    });
                }
            }

            this.ciudadesR = [{}];
            this.ciudadesR = this.ciudadesfilteredR;

            this.ciudadesR[0].value = null;
            this.ciudadesR[0].text = 'Seleccionar';
        },
        verifyAge(memberAge) {
            if (memberAge == '' || memberAge == null) return true;
            this.today = new Date();
            var dd = this.today.getDate();
            var mm = this.today.getMonth() + 1;
            var yyyy = this.today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            this.today = yyyy + '-' + mm + '-' + dd;
            var todaydate = new Date(this.today);
            var agedate = new Date(memberAge);
            var verif = todaydate.valueOf() - agedate.valueOf();
            var edad = verif / (1000 * 60 * 60 * 24);
            edad = Math.trunc(edad / 365);

            if (edad < 18) {
                this.mayoredad = false;
            } else if (edad <= 18) {
                this.mayoredad = true;
            }
            return this.mayoredad;
        },

        add() {
            var path = window.location.pathname;
            path = path.replace(/\D/g, '');
            const params = {
                dociden: this.member.dociden,
                nom1: this.member.nom1,
                nom2: this.member.nom2,
                ape1: this.member.ape1,
                ape2: this.member.ape2,
                genero: this.member.genero,
                fec_nac: this.member.fec_nac,
                pais: this.member.pais,
                ciudad: this.member.ciudad,
                urbanizacion: this.member.urbanizacion,
                calle: this.member.calle,
                zipcode: this.member.zipcode,
                codp: this.member.codp,
                coda: this.member.coda,
                telefono: this.member.telefono,

                /* Representante*/
                docidenR: this.rep.dociden,
                nom1R: this.rep.nom1,
                nom2R: this.rep.nom2,
                ape1R: this.rep.ape1,
                ape2R: this.rep.ape2,
                fec_nacR: this.rep.fec_nac,
                paisR: this.rep.pais,
                ciudadR: this.rep.ciudad,
                urbanizacionR: this.rep.urbanizacion,
                calleR: this.rep.calle,
                zipcodeR: this.rep.zipcode,

                club: path,
                today: this.today,
            };

            //console.log(params);
            axios.post(`/clubs/${path}/members`, params)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${path}/members/${this.member.dociden}/favorites`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate() {
            let msg = '';
            /* MEMBER */
            if (this.validateD == null) msg = msg + "El campo Documento de Identidad no puede estar vacío<br>";
            if (this.validateD == false) msg = msg + "El campo Documento de Identidad debe ser numérico de no más de 8 caracteres<br>";
            if (this.docExists == true) msg = msg + 'El documento de identidad ingresado ya existe, si este miembro no tiene club por favor diríjase a la opción <a v-bind:href="/">Añadir agente libre</a> en el menú<br>';
            if (this.validateN == null) msg = msg + "El campo Nombre de Lector no puede estar vacío<br>";
            if (this.validateN == null) msg = msg + "El campo Nombre de Lector no puede tener más de 20 caracteres<br>";
            if (this.validateSN == false) msg = msg + "El campo Segundo Nombre de Lector no puede tener más de 20 caracteres<br>";
            if (this.validateA == null) msg = msg + "El campo Apellido de Lector no puede estar vacío<br>";
            if (this.validateA == false) msg = msg + "El campo Apellido de Lector no puede tener más de 20 caracteres<br>";
            if (this.validateSA == null) msg = msg + "El campo Segundo Apellido de Lector no puede estar vacío<br>";
            if (this.validateSA == false) msg = msg + "El campo Segundo Apellido de Lector no puede estar vacío ni tener más de 20 caracteres<br>";
            if (this.validateG == false) msg = msg + "El campo Género no puede estar vacío<br>";
            if (this.validateF == false) msg = msg + "El campo Fecha de Nacimiento de Lector no puede estar vacío y miembro debe tener más de 9 años<br>";
            if (this.validateCP == null) msg = msg + "El campo Código de País debe ser número entero, no puede estar vacío<br>";
            if (this.validateCP == false) msg = msg + "El campo Código de País debe ser número entero, no puede tener más de 3 caracteres<br>";
            if (this.validateCODA == null) msg = msg + "El campo Código de Área no puede estar vacío<br>";
            if (this.validateCODA == false) msg = msg + "El campo Código de Área debe ser número entero, no puede tener más de 5 caracteres<br>";
            if (this.validateT == null) msg = msg + "El campo Número de Teléfono no puede estar vacío<br>";
            if (this.validateT == false) msg = msg + "El campo Número de Teléfono debe ser un número entero, de no más de 10 caracteres<br>";
            if (this.validateP == false) msg = msg + "El campo País de Lector no puede estar vacío<br>";
            if (this.validateCI == false) msg = msg + "El campo Ciudad de Lector no puede estar vacío<br>";
            if (this.validateU == null) msg = msg + "El campo Urbanización (Lector) no puede estar vacío<br>";
            if (this.validateU == false) msg = msg + "El campo Urbanización (Lector) no puede tener más de 20 caracteres<br>";
            if (this.validateCA == null) msg = msg + "El campo Calle (Lector) no puede estar vacío<br>";
            if (this.validateCA == false) msg = msg + "El campo Calle (Lector) no puede tener más de 20 caracteres<br>";
            if (this.validateZ == false) msg = msg + "El campo Código postal (Lector) debe ser un número entero y no puede tener más de 7 caracteres<br>";

            if (!this.mayoredad) {
                if (this.validateDR == null) msg = msg + "El campo Documento de Identidad de Representante no puede estar vacío<br>";
                if (this.validateDR == false) msg = msg + "El campo Documento de Identidad debe ser un número entero positivo de no más de 8 caracteres<br>";
                if (this.validateNR == null) msg = msg + "El campo Nombre (Representante) no puede estar vacío<br>";
                if (this.validateNR == false) msg = msg + "El campo Nombre (Representante) no puede tener más de 20 caracteres<br>";
                if (this.validateSNR == false) msg = msg + "El campo Segundo Nombre (Representante) no puede tener más de 20 caracteres<br>";
                if (this.validateAR == null) msg = msg + "El campo Apellido (Representante) no puede estar vacío<br>";
                if (this.validateAR == false) msg = msg + "El campo Apellido (Representante) no puede tener más de 20 caracteres<br>";
                if (this.validateSAR == false || this.validateSAR == null) msg = msg + "El campo Segundo Apellido (Representante) no puede estar vacío ni tener más de 20 caracteres\n";
                if (this.validateFR == false) msg = msg + "El campo Fecha de Nacimiento (Representante) no puede estar vacío y el representante debe ser mayor de 18 años<br>";
                if (this.validatePR == false) msg = msg + "El campo País (Representante) no puede estar vacío<br>";
                if (this.validateCIR == false) msg = msg + "El campo Ciudad (Representante) no puede estar vacío<br>";
                if (this.validateUR == null) msg = msg + "El campo Urbanización (Representante) no puede estar vacío<br>";
                if (this.validateUR == false) msg = msg + "El campo Urbanización (Representante) no puede tener más de 20 caracteres<br>";
                if (this.validateCAR == null) msg = msg + "El campo Calle (Representante) no puede estar vacío<br>";
                if (this.validateCAR == false) msg = msg + "El campo Calle (Representante) no puede tener más de 20 caracteres<br>";
                if (this.validateZR == false) msg = msg + "El campo Código postal (Representante) debe ser numérico entero y no puede tener más de 7 caracteres<br>";
            }

            if (msg == '') {
                this.add();
            } else {
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-left">' + msg + '</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            }
        }
    }
}
</script>

<style>

</style>
