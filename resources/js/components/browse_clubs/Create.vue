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
                                    <b-form>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Nombre</label>
                                                <b-form-input id="nom" name="nom" required placeholder="Nombre de club"></b-form-input>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="idioma">Idioma</label>
                                                <b-form-select v-model="idioma" :options="idiomas"></b-form-select>
                                            </b-col>
                                        </b-row>
                                        <br>
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

                                        <b-row>
                                            <b-col cols="6">
                                                <b-form-group>
                                                    <label>¿Está asociado este club a alguna institución?</label>
                                                    <b-radio-group v-model="asociado" :options="[{text: 'Sí', value:
                true}, {text: 'No', value: false}]">
                                                    </b-radio-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>
                                        <div v-if="asociado">
                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="inom">Nombre</label>
                                                    <b-form-input type="text" v-model="nombrei" id="inom" name="inom" placeholder="Nombre">Nombre</b-form-input>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="">Tipo</label>
                                                    <b-form-select v-model="tipo" id="tipo" name="tipo" :options="tipos"></b-form-select>
                                                </b-col>
                                            </b-row>
                                            <br>

                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="pais">País</label>
                                                    <b-form-select v-model="paisI" id="paisI" name="paisI" :options="paises"></b-form-select>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ciudad">Ciudad</label>
                                                    <b-form-select v-model="ciudadI" id="ciudadI" name="ciudadI" :options="ciudades"></b-form-select>
                                                </b-col>
                                            </b-row>
                                            <br>

                                            <b-row>

                                                <b-col cols="4">
                                                    <label for="urbanizacion">Urbanización</label>
                                                    <b-form-input v-model="urbanizacionI" id="urbanizacionI" name="urbanizacionI" placeholder="Urbanización"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="calle">Calle</label>
                                                    <b-form-input v-model="calleI" id="calleI" name="calleI" placeholder="Calle"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="zipcode">Código postal</label>
                                                    <b-form-input v-model="zipcodeI" id="zipcodeI" name="zipcodeI" placeholder="Código postal"></b-form-input>
                                                </b-col>

                                            </b-row>
                                        </div>
                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <b-form-group>
                                                    <label>¿Está asociado este club con otro club?</label>
                                                    <b-radio-group v-model="clubasociado" :options="[{text: 'Sí', value:
                true}, {text: 'No', value: false}]">
                                                    </b-radio-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>

                                        <b-row v-if="clubasociado">
                                            <b-col cols="6">
                                                <label>Seleccione los clubes asociados</label>
                                                <b-form-group>
                                                    <b-form-checkbox-group v-model="cac" :options="asociados" name="asociados" stacked></b-form-checkbox-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" type="submit">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/browseclubs">Cancelar</b-link>
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
            nombre: null,
            idioma: null,
            idiomas: [{
                value: null,
                text: 'Seleccionar',
            }],
            asociado: false,
            nombrei: null,
            tipo: null,
            tipos: [{
                value: null,
                text: 'Seleccionar',
            }],
            pais: null,
            paisI: null,
            paises: [{
                value: null,
                text: 'Seleccionar',
            }],
            ciudad: null,
            ciudadI: null,
            ciudades: [{
                value: null,
                text: 'Seleccionar'
            }],
            urbanizacion: null,
            urbanizacionI: null,
            calle: null,
            calleI: null,
            zipcode: null,
            zipcodeI: null,
            clubasociado: false,
            asociados: [{
                value: 1,
                text: 'Killer Bees'
            }],
            cac: [],

        }
    }
}
</script>

<style>

</style>
