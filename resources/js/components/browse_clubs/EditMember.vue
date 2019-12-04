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
                                    <h4 class="card-title">Modificar miembro de club</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">´
                                    <br>
                                    <b-form>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="dociden">Documento de identidad</label>
                                                <b-form-input type="text" v-model="dociden" id="dociden" name="dociden" placeholder="Documento de identidad"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="nom1">Primer nombre</label>
                                                <b-form-input type="text" v-model="nom1" id="nom1" name="nom1" placeholder="Primer nombre"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="nom2">Segundo nombre</label>
                                                <b-form-input type="text" v-model="nom2" id="nom2" name="nom2" placeholder="Segundo nombre"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="ape1">Primer apellido</label>
                                                <b-form-input type="text" v-model="ape1" name="ape1" id="ape1" placeholder="Primer apellido"></b-form-input>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ape2">Segundo apellido</label>
                                                <b-form-input type="text" v-model="ape2" name="ape2" id="ape2" placeholder="Segundo apellido"></b-form-input>
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="genero">Género</label>
                                                <b-form-select v-model="genero" :options="generos" id="genero"></b-form-select>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="fec_nac">Fecha de Nacimiento</label>
                                                <b-form-input type="date" v-model="fec_nac" v-on:input="verifyAge(fec_nac)" name="fec_nac" id="fec_nac"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="telefono">Teléfono</label>
                                                <b-form-input type="tel" v-model="telefono" name="telefono" id="telefono"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="pais">País</label>
                                                <b-form-select v-model="pais" id="pais" name="pais" :options="paises"></b-form-select>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ciudad">Ciudad</label>
                                                <b-form-select v-model="ciudad" id="ciudad" name="ciudad" :options="ciudades"></b-form-select>
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="4">
                                                <label for="urbanizacion">Urbanización</label>
                                                <b-form-input v-model="urbanizacion" id="urbanizacion" name="urbanizacion" placeholder="Urbanización"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="calle">Calle</label>
                                                <b-form-input v-model="calle" id="calle" name="calle" placeholder="Calle"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="zipcode">Código postal</label>
                                                <b-form-input v-model="zipcode" id="zipcode" name="zipcode" placeholder="Código postal"></b-form-input>
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
                                                    <b-form-input type="text" v-model="docidenR" id="docidenR" name="docidenR" placeholder="Documento de identidad"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="nom1R">Primer nombre</label>
                                                    <b-form-input type="text" v-model="nom1R" id="nom1R" name="nom1R" placeholder="Primer nombre"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="nom2R">Segundo nombre</label>
                                                    <b-form-input type="text" v-model="nom2R" id="nom2R" name="nom2R" placeholder="Segundo nombre"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="ape1R">Primer apellido</label>
                                                    <b-form-input type="text" v-model="ape1R" name="ape1R" id="ape1R" placeholder="Primer apellido"></b-form-input>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ape2R">Segundo apellido</label>
                                                    <b-form-input type="text" v-model="ape2R" name="ape2R" id="ape2R" placeholder="Segundo apellido"></b-form-input>
                                                </b-col>
                                            </b-row>
<br>
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="generoR">Género</label>
                                                    <b-form-select v-model="generoR" :options="generos" id="genero"></b-form-select>
                                                </b-col>
                                                
                                                <b-col cols="4">
                                                    <label for="fec_nacR">Fecha de Nacimiento</label>
                                                    <b-form-input type="date" v-model="fec_nacR" name="fec_nacR" id="fec_nacR"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="telefonoR">Teléfono</label>
                                                    <b-form-input type="tel" v-model="telefonoR" id="telefonoR" name="telefonoR"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="paisR">País</label>
                                                <b-form-select v-model="paisR" id="paisR" name="paisR" :options="paises"></b-form-select>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="ciudadR">Ciudad</label>
                                                <b-form-select v-model="ciudadR" id="ciudadR" name="ciudadR" :options="ciudades"></b-form-select>
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="4">
                                                <label for="urbanizacionR">Urbanización</label>
                                                <b-form-input v-model="urbanizacionR" id="urbanizacionR" name="urbanizacionR" placeholder="Urbanización"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="calleR">Calle</label>
                                                <b-form-input v-model="calleR" id="calle" name="calleR" placeholder="Calle"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="zipcodeR">Código postal</label>
                                                <b-form-input v-model="zipcodeR" id="zipcodeR" name="zipcodeR" placeholder="Código postal"></b-form-input>
                                            </b-col>

                                        </b-row>
                                        
                                        </div>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" type="submit">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/managemembers">Cancelar</b-link>
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
export default {
    data() {
        return {
            dociden: null,
            docidenR: null,
            nom1: null,
            nom1R: null,
            nom2: null,
            nom2R: null,
            ape1: null,
            ape1R: null,
            ape2: null,
            ape2R: null,
            genero: null,
            generoR: null,
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
            }],
            fec_nac: null,
            fec_nacR: null,
            pais: null,
            paisR: null,
            paises: [{
                value: null,
                text: 'Seleccionar',
            }],
            ciudad: null,
            ciudadR: null,
            ciudades: [{
                value: null,
                text: 'Seleccionar'
            }],
            urbanizacion: null,
            urbanizacionR: null,
            calle: null,
            calleR: null,
            zipcode: null,
            zipcodeR: null,
            telefono: null,
            telefonoR: null,
            mayoredad: true,            
        }
    },
    methods:{
        verifyAge(memberAge){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() +1;
            var yyyy = today.getFullYear();

            if (dd<10){
                dd = '0'+dd;
            }

            if(mm<10){
                mm='0'+mm;
            }

            var today= yyyy+'-'+mm+'-'+dd;
            var todaydate = new Date(today);
            var agedate = new Date(memberAge);
            var verif = todaydate.valueOf()-agedate.valueOf();
            var edad = verif/(1000*60*60*24);
            edad = Math.trunc(edad/365);

                if (edad < 18){
                    this.mayoredad = false;
                }
                else if (edad <= 18){
                    this.mayoredad = true;
                }
                console.log(this.mayoredad);
            return this.mayoredad;
        }
    }
}
</script>

<style>

</style>
