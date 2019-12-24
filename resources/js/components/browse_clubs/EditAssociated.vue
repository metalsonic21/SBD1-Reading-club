<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">people</i>
                            </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h4 class="card-title">Modificar clubes asociados</h4>
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
                                            <p><strong>NOMBRE DEL CLUB: </strong>{{this.club.nom}}</p>
                                        </b-col>
                                        <b-col cols="6">
                                            <p><strong>IDIOMA: </strong>{{this.idioma.nom}}</p>
                                        </b-col>
                                        </b-row>
                                        
                                        <hr>
                                        <b-row>
                                            <b-col>
                                                <h5>Seleccione un club para asociar con {{this.club.nom}}</h5>
                                                <br>
                                                <h6>Clubes disponibles</h6>                      

                                                <b-form-group>
                                                    <b-form-checkbox-group v-model="selectedclubs" :options="asociados" name="asociados" stacked></b-form-checkbox-group>
                                                </b-form-group>

                                                <small>Sólo pueden asociarse clubes que hablen el mismo idioma</small>
                                            </b-col>
                                        </b-row>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="update">Continuar</b-button>
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
                id_idiom: null,
            },
       
            idioma: null,

            asociados: [{
                value: 0,
                text: 'Club Asociado',
                idiom: null,
            }],

            asociadosbackup: [{
                value: 0,
                text: 'Club Asociado',
                idiom: null,
            }],

            aclubid: [{
                value: 0,
                text: 'Club Asociado'
            }],

            selectedclubs: [{}],
            selectedclubs2: [{}],            
        }
    },

    created() {
        var params = window.location.pathname;
        params = params.replace(/\D/g, '');
        axios.get(`/browseclubs/${params}/editassociated`)
            .then(res => {
                this.idioma = res.data.language;
                this.asociados = res.data.aclubs;
                
                this.id = res.data.club.id;
                this.club.nom = res.data.club.nom;
                this.club.id_idiom = res.data.club.id_idiom;

                this.selectedclubs2 = res.data.aclubsid;

                this.filterasoc();
            
            }).catch(e => {
                console.log(e);
            })
    },
    
    methods: {
        filterasoc(){
            //eliminar elemento repetido y elementos con idioma distinto

           
            let i = 0;
            for (i=0;i < this.asociados.length;i++){
                if(this.asociados[i].value == this.id || this.asociados[i].idiom != this.club.id_idiom ){    
                    this.asociados.splice(i,1);
                    i--;
                }
            }
           
            
            //cargar marcados
            for (i = 0; i < this.selectedclubs2.length; i++) {
                this.selectedclubs[i+1] = this.selectedclubs2[i].id_a ;             
            }
        },

        update(){
            const params = {
                asociados: this.selectedclubs,
            }

            axios.put(`/browseclubs/${this.id}/editassociated`,params)
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
