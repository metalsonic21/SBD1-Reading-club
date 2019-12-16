<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">theaters</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Elenco para la {{nom_obra}} del club {{nom_club}}</h4>
                                </div>
                                <div class="col-lg-2">
                                    <b-link  href="#" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Agregar Actor
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="text-center">Seleccione un personaje</h6>
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Elenco</th>
                                                    <th class="text-center">Personaje</th>
                                                    <th class="text-center">Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <div                                                
                                                      v-for="actor in actores"
                                                        v-bind:item="item"
                                                        
                                                        v-bind:key="actor.id"
                                                    >

                                                        <td class="text-center">  </td>
                                                        <td class="text-center"></td>
                                                        <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.details-character> Datos Personaje 
                                                            </button>
                                                        </td>
                                                        <b-modal size="lg" id="details-character" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
                                                            <div class="card ">
                                                                <div class="card-header card-header-log card-header-icon">
                                                                    <div class="card-icon">
                                                                        <i class="material-icons">movie</i>
                                                                    </div>
                                                                    <h3 class="card-title"></h3>
                                                                </div>
                                                                <div class="card-body ">
                                                                    <b-form>
                                                                        <h4>Decripción del personaje:</h4>
                                                                        <p align="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni nam labore excepturi doloremque ut laboriosam nobis, exercitationem itaque perferendis sunt. Vero quaerat, modi alias suscipit architecto maiores nam quia, ut consequuntur sed qui nobis porro a quisquam temporibus perspiciatis expedita aliquam delectus accusamus magni eaque voluptatem harum odio! Dicta, ullam.</p>
                                                                    </b-form>
                                                                </div>
                                                            </div>
                                                        </b-modal>
                                                    </div>
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


    
</div>
</template>

<script>
    export default {
        data(){
            return{
                id_obra:'',
                nom_obra:'',
                id_club:'',
                nom_club:'',
                id_lec:'',
                nom1_lec:'',
                nom2_lec:'',
                ape1_lec:'',
                ape2_lec:'',
                id_pers:'',
                nom_pers:'',
                descrip_pers:'',
                actores:'',
                id_local:'',
                nom_local:'',
            }
        },
        created(){                        
        },
        methods:{

        },

        mounted() {
            console.log('Component mounted.');
            
            let path = window.location.pathname+'/';
            let iclub = path.indexOf("/",0)+6;
            let fclub = path.indexOf('/',iclub);
            this.link1 = parseInt(path.substring(iclub,fclub),10);
            let fobra = path.indexOf('/',fclub+6);
            this.link2 = parseInt(path.substring(fclub+6,fobra),10);
            let fperf = path.indexOf('/',fobra+7);
            this.link3 = parseInt(path.substring(fobra+7,fperf),10);
            this.link5 = parseInt(path.substring(fobra+12,fperf),10);
            this.link6 = parseInt(path.substring(fobra+15,fperf),10);
            let local = path.indexOf('/',fperf+7);
            this.link4 = parseInt(path.substring(fperf+7,local));     
            console.log(path);  
            console.log(this.link1);
            console.log(this.link2);
            console.log(this.link3+'-'+this.link5+'-'+this.link6); 
            console.log(this.link4);
            
           axios.get(`create`)
            .then(res => {                
                this.actores = res.data.actores;
                this.id_club = res.data.club.id;
                this.club = res.data.club.nom;
                this.id_obra = res.data.obra.id;
                this.obra = res.data.obra.nom;
                this.id_local = res.data.local.id;
                this.nom_local = res.data.local.nom;                
                
                console.log (res.data.locales);
            }).catch(e => {
                console.log(e);
            })
        

        }
    }
</script>