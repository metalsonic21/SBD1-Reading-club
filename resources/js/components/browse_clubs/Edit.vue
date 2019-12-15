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
                                    <h4 class="card-title">Modificar club de lectura</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="update">
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Nombre</label>
                                                <b-form-input v-model="club.nom" type="text" id="nom" name="nom"  placeholder="Nombre de club"></b-form-input>
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
                                                <b-form-select v-model="dir.pais" id="pais" name="pais" :options="paises" 
                                                @change="filter(dir.pais, dir.ciudad)"></b-form-select>
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
                                            </b-col>

                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="5">
                                                <label for="cuota">Cuota del Club</label>
                                                <b-form-input v-model="club.cuota" type="number" min="1" pattern="^[0-9]+" id="cuota" name="cuota" placeholder="Cuota del Club"></b-form-input>
                                            </b-col>

                                        </b-row>

                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <b-form-group>
                                                    <label>¿Está asociado este club a alguna institución?</label>
                                                    <b-radio-group v-model="institucion" :options="[{text: 'Sí', value:true}, {text: 'No', value: false}]"></b-radio-group>
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
                                                    <b-form-input type="text" v-model="inst.tipo" id="tipo" name="tipo" placeholder="Tipo de institucion"></b-form-input>
                                                    <b-form-invalid-feedback :state="validateItipo">Debe rellenar el campo Tipo de Institucion</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <br>

                                            <b-row>
                                                <b-col cols="6">
                                                    <label for="pais">País</label>
                                                    <b-form-select v-model="inst.pais" id="paisI" name="paisI" :options="paises"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateIpais">Debe selecionar un pais para la Institucion</b-form-invalid-feedback>
                                                </b-col>

                                                <b-col cols="6">
                                                    <label for="ciudad">Ciudad</label>
                                                    <b-form-select v-model="inst.ciudad" id="ciudadI" name="ciudadI" :options="ciudades"></b-form-select>
                                                    <b-form-invalid-feedback :state="validateIciu">Debe selecionar una ciudad para la Institucion</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <br>
                                        </div>
                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <b-form-group>
                                                    <label>¿Está asociado este club con otro club?</label>
                                                    <b-radio-group v-model="clubasociado" :options="[{text: 'Sí', value:true}, {text: 'No', value: false}]">
                                                    </b-radio-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>

                                        <b-row v-if="clubasociado">
                                            <b-col cols="6">
                                                <label>Seleccione los clubes asociados</label>
                                                
                                                <b-form-group>
                                                    <b-form-checkbox-group v-model="selectedclubs" :options="asociados" name="asociados" stacked></b-form-checkbox-group>
                                                </b-form-group>
                                                  
                                            </b-col>
                                        </b-row>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="revalidate">Continuar</b-button>

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
            id: null,
            club: {
                nom: null,
                cuota: null,
                id_idiom: null,
            },

            dir: {
                pais: null,
                ciudad: null,
                urb: null,
                calle:null,
                cod_post: null,
            },
       
            idiomas: [{
                value: null,
                text: 'Seleccionar',
            }],
            institucion: false,

            inst:{
                nom: null,
                tipo: null,
                ciudad: null,
                pais: null,
            },
        
            paises: [{
                value: null,
                text: 'Seleccionar',
            }],
            
            ciudades: [{
                value: null,
                text: 'Seleccionar',
            }],

            clubasociado: false,

            asociados: [{
                value: 1,
                text: 'Club Asociado',
            }],

            asociadosbackup: [{
                value: 1,
                text: 'Club Asociado',
            }],

            aclubid: [{
                value: 1,
                text: 'Club Asociado'
            }],

            selectedclubs: [{}],
            selectedclubs2: [{}],

            ciudadesfiltered: [{}],
            ciudadesbackup: [{
                value: null,
                text: 'Seleccionar'
            }],
            
        }
    },

    created() {
        var params = window.location.pathname;
        params = params.replace(/\D/g, '');
        axios.get(`/browseclubs/${params}/edit`)
            .then(res => {
                this.idiomas = res.data.languages;
                this.paises = res.data.countries;
                this.ciudadesbackup = res.data.cities;
                this.asociados = res.data.aclubs;
                
                this.id = res.data.club.id;
                this.club.nom = res.data.club.nom;
                this.club.cuota = res.data.club.cuota;
                this.club.id_idiom = res.data.club.id_idiom;

                this.dir.pais = res.data.direction.pais; 
                this.filter(res.data.direction.pais, res.data.direction.ciudad)
                this.dir.ciudad = res.data.direction.ciudad; 

                this.dir.urb = res.data.direction.urb;
                this.dir.calle = res.data.direction.calle;
                this.dir.cod_post = res.data.direction.codigo;
                if(res.data.club.id_inst != null){
                    this.institucion = true;
                    this.inst.nom = res.data.institution.inst;
                    this.inst.tipo = res.data.institution.tipo;
                    this.inst.ciudad = res.data.institution.ciudad;
                    this.filter(res.data.institution.pais, res.data.institution.ciudad);
                    this.inst.pais = res.data.institution.pais;
                }

                this.selectedclubs2 = res.data.aclubsid;

                this.filterasoc();
            
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {

        //Validations
        validateNom(){
            return (this.club.nom != null);
        },
        validateIdiom(){
            return (this.club.id_idiom != null);
        },
        validatePais(){
            return (this.dir.pais != null);
        },
        validateCiu(){
            return (this.dir.ciudad != null);
        },
        validateUrb(){
            return (this.dir.urb != null);
        },
        validateCalle(){
            return (this.dir.calle != null);
        },
        validateInom(){
            if(this.institucion == true){
                if(this.inst.nom != null){
                    return true;
                }else{
                    return false;
                }
            }
            return true;
        },  
        validateItipo(){
            if(this.institucion == true){
                if(this.inst.tipo != null){
                    return true;
                }else{
                    return false;
                }
            }
            return true;
        },
        validateIpais(){
            if(this.institucion == true){
                if(this.inst.pais != null){
                    return true;
                }else{
                    return false;
                }
            }
            return true;
        },   
        validateIciu(){
            if(this.institucion == true){
                if(this.inst.ciudad != null){
                    return true;
                }else{
                    return false;
                }
            }
            return true;
        },
    },
    methods: {
        filterasoc(){
            //eliminar elemento repetido
            let i = 0;
            for (i=0;i < this.asociados.length;i++){
                if(this.asociados[i].value == this.id){
                    this.asociados.splice(i,1);
                }
            }
            //mostrar panel
            if(this.selectedclubs2.length > 0){
                this.clubasociado = true;
            }
            //cargar marcados
            for (i = 0; i < this.selectedclubs2.length; i++) {
                this.selectedclubs[i+1] = this.selectedclubs2[i].id_a              
            }
        },

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

        revalidate(){
            let msg = '';
            let isValid = true;

                if (this.validateNom == false) msg = msg + "Debe rellenar el campo Nombre del Club\n";
                if (this.validateIdiom == false) msg = msg + "Debe selecionar un idioma\n";
                if (this.validatePais == false) msg = msg + "Debe selecionar un pais\n";
                if (this.validateCiu == false) msg = msg + "Debe selecionar una ciudad\n";
                if (this.validateUrb == false) msg = msg + "Debe rellenar el campo Urbanización\n";
                if (this.validateCalle == false) msg = msg + "Debe rellenar el campo calle\n";
                if (this.validateInom == false) msg = msg + "Debe rellenar el campo Nombre de Institución\n";
                if (this.validateItipo == false) msg = msg + "Debe rellenar el campo Tipo de Institución\n";
                if (this.validateIpais == false) msg = msg + "Debe selecionar un pais para la Institución\n";
                if (this.validateIciu == false) msg = msg + "Debe selecionar una ciudad para la Institución\n";

                if (msg!=''){
                    isValid = false;
                    alert(msg);
                }
                else {
                    this.update();
                }
        },
        update(){
            if(!this.institucion){
                this.inst.nom = false;
            }

            const params = {
                
                nom: this.club.nom,
                cuota: this.club.cuota,
                id_idiom: this.club.id_idiom,

                calle: this.dir.calle,
                ciudad: this.dir.ciudad,
                urb: this.dir.urb,
                cod_post: this.dir.cod_post,
                asociados: this.selectedclubs,
                
                nom_inst: this.inst.nom,
                tipo_inst: this.inst.tipo,
                ciudad_inst: this.inst.ciudad,
            }

            //Clear 
            this.club.nom = '';
            this.club.cuota = '';
            this.club.in_dir = '';
            this.club.id_idiom = '';
            this.club.id_inst = '';

            axios.put(`/browseclubs/${this.id}`,params)
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
