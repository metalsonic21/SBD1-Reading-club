<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">videocam</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Presentaciones</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link v-bind:href="'/clubs/'+club+'/presentaciones/create'" class="btn btn-default float-right mt-3" v-b-modal.add-group>
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear presentación
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="material-datatables">
                                        <table class="table table-sales table-hover table-no-bordered" id="myTable" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Obra</th>
                                                    <th class="text-center">Local</th>
                                                    <th class="text-center">Hora de inicio</th>
                                                    <th class="text-center">Duración</th>
                                                    <th class="text-center">Valoración</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in presentaciones" :key="index">
                                                    <td class="text-center">{{item.fec}}</td>
                                                    <td class="text-center">{{item.nombre}}</td>
                                                    <td class="text-center">{{item.lugar}}</td>
                                                    <td class="text-center">{{item.hora_i}}</td>
                                                    <td class="text-center">{{item.durac}}</td>
                                                    <td class="text-center">{{item.valor}}</td>
                                                    <td class="td-actions text-center">
                                                    <div class="d-flex flex-row-reverse bd-highlight">
                                                        <b-button variant="default" @click="pdf(item.fec,item.obra,item.idlugar)">Continuar</b-button>
                                                    </div>
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

</div>
</template>

<script>
export default {    
    props: ['idclub','fechai','fechaf'],        
    

    data() {
        return {
            presentaciones: [],
            club: null,
            }
        },

    created(){
        axios.get(`/clubs-reports-perform/${this.idclub}/${this.fechai}/${this.fechaf}`)
            .then(res => {
                this.presentaciones = res.data.data;
                console.log(this.presentaciones);
            }).catch(e => {
                console.log(e);
            })
    },
    
    computed: {
        
    },
    methods: {
            pdf(fec,id_obra,id_local) {       
            
            const met ={
                fec:fec,
                obra:id_obra,
                local:id_local,
                club:this.idclub,
            }
            console.log(this.idclub);
            axios.post(`/clubs-reports-perform/generate`,met)
                .then(res =>{
                    window.location = `/reports-perform/${met.fec}/${met.obra}/${met.local}/${met.club}`;
                }).catch(e=>{
                    console.log(e)
                })
        },
        showModal(item) {
            item = item.toString();
            this.$bvModal.show(item);
        },
        hideModal(item) {
            item = item.toString();
            this.$bvModal.hide(item);
        },
    }
}
</script>
