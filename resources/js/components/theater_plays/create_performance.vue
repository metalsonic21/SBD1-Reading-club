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
                                    <h4 class="card-title">Añadir nueva Presentación del club: {{club}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">De la obra: {{obra}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="Ubicacion">Ubicación</label>
                                                <b-form-select v-model="local" :options="locales" ></b-form-select>
                                                <div class="mt-3">Selected: <strong>{{ local }}</strong></div>
                                            </b-col>
                                            <b-col cols="6">
                                                <label for="Fecha">fecha</label>
                                                <b-form-input type="date" required v-model="fecha" id="date" name="date1"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="Nombre">Hora de inicio</label>
                                                <b-form-input type="time" required v-model="hora_i" id="hora" name="hora"></b-form-input>
                                            </b-col>
                                            <b-col cols="3">
                                                <label for="Nombre">Duracion de la obra(Horas)</label>
                                                <b-form-input type="number" required v-model="durach" id="duracionh" min=0 name="duracionh"></b-form-input>
                                            </b-col>
                                            <b-col cols="3">
                                                <label for="Nombre">Duracion de la obra(Minutos)</label>
                                                <b-form-input type="number" required v-model="duracm" id="duracionh" min=0 name="duracionh"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="Costo">Costo de la entrada</label>
                                                <b-form-input type="number" required v-model="costo" min=0 id="cost" name="cost"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" type="submit">Continuar</b-button>
                                            <b-link class="btn btn-danger" href="/castplays">Cancelar</b-link>
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
                        club:'',
                        id_club: '',
                        obra:'',
                        id_obra: '',
                        calle : '',
                        urb: '',
                        ciudad: '',
                        local: '',
                        locales: [{}],
                        fecha:'',
                        hora_i:'',
                        durach:'',
                        duracm:'',
                        duracion:'',
                        costo:'',
                        link1:'',
                        link2:'',
                        id_local:'',

    }},
        created() {
            let path = window.location.pathname;
            let iclub = path.indexOf("/",0)+1;
            let fclub = path.indexOf('/',iclub);
            this.link1 = parseInt(path.substring(iclub,fclub),10);
            let fobra = path.indexOf('/',fclub+1);
            this.link2 = parseInt(path.substring(fclub+1,fobra),10);      
            console.log(this.link1);
            console.log(this.link2); 
        axios.get(`/${this.link1}/${this.link2}/perform/create`)
            .then(res => {                
                this.locales = res.data.locales;
                this.id_club = res.data.club.id;
                this.club = res.data.club.nom;
                this.id_obra = res.data.obra.id;
                this.obra = res.data.obra.nom;
                console.log (res.data.locales);
            }).catch(e => {
                console.log(e);
            })
    },
        mounted() {
            console.log('Component mounted.')
        },
        methods :{
            add() {
                 var myDate = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                
            const params = {
                    fec:this.fecha,
                    id_obra:this.id_obra,
                    id_local:this.local,
                    hora_i:this.hora_i,                    
                    durach:this.durach,
                    duracm:this.duracm,
                    costo:this.costo,
                    id_club:this.id_club,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };


            axios.post(`/${this.link1}/${this.link2}/perform`, params)
                .then(res => {
                    this.fecha='';
                    this.id_obra='';
                    this.id_local='';
                    this.hora_i='';
                    this.durac='';
                    this.costo='';
                    this.id_club='';
                    window.location = `/${this.link1}/${this.link2}/perform`;
                }).catch(e => {
                    console.log(e);
                })
        },
        }
    }
</script>