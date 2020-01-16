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
                                    <h4 class="card-title">Generar reporte para miembros de los clubes</h4>
                                </div>
                                <div class="col-lg-2">
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form>
                                        <hr>
                                        <b-row>
                                            <b-col cols="4">
                                                <h6 class="ml-3"><strong>LISTA DE MIEMBROS</strong></h6>
                                            </b-col>
                                        </b-row>
                                        
                                        <p>Seleccione un miembro y las fechas limite para generar el reporte</p>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="fec__i">Fecha limite inferior</label>
                                                <b-form-input type="date" v-model="fec_i" id="fec_i" name="fec_i"></b-form-input>
                                                <b-form-invalid-feedback :state="validateF_i">* Requerido</b-form-invalid-feedback>
                                            </b-col>
                                            <b-col cols="6">
                                                <label for="fec_f">Fecha limite superior</label>
                                                <b-form-input type="date" v-model="fec_f" id="fec_f" name="fec_f"></b-form-input>
                                                <b-form-invalid-feedback :state="validateF_f">* Requerido</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="12">
                                                <b-form-group label-for="filterInput" class="mb-0">
                                                    <b-input-group>
                                                        <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Escribe para buscar"></b-form-input>
                                                        <b-input-group-append>
                                                            <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
                                                        </b-input-group-append>
                                                    </b-input-group>
                                                </b-form-group>
                                                <b-table selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="lg" id="my-table" :per-page="perPage" :current-page="currentPage" small sort-by="Miembro" :filter="filter" :filterIncludedFields="filterOn" @filtered="onFiltered">
                                                    <!-- Example scoped slot for select state illustrative purposes -->
                                                    <template v-slot:cell(seleccionado)="{ rowSelected }">
                                                        <template v-if="rowSelected">
                                                            <span aria-hidden="true">&check;</span>
                                                            <span class="sr-only">Seleccionado</span>
                                                        </template>
                                                        <template v-else>
                                                            <span aria-hidden="true">&nbsp;</span>
                                                            <span class="sr-only">No seleccionado</span>
                                                        </template>
                                                    </template>
                                                </b-table>
                                            </b-col>
                                        </b-row>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table"></b-pagination>
                                        </div>
                                    </b-form>
                                    <br>
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <b-button variant="default" @click="revalidate">Continuar</b-button>
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
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            selected: [],
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'doc_identidad','miembro','fecha_de_nacimiento'],
            items: [],
            selected: [],
            filterOn: [],
            filter: null,
            fec_i: null,
            fec_f: null
        }
    },

    created() {
        axios.get(`/chronlogy-reports`)
            .then(res => {
                this.items = res.data.data;
                //console.log(this.items);
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {
        onRowSelected(items) {
            this.selected = items
        },

        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },

        generate() {
            const params = {
                doc: this.selected[0].doc_identidad,
                member: this.selected,
                fec_i: this.fec_i,
                fec_f: this.fec_f,
            };
            
            console.log(params);

            axios.post(`/cronomembers`, params)
                .then(res => {
                    window.location = `/chronlogy-reports/${params.doc}/${params.fec_i}/${params.fec_f}`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate() {
            let msg = '';
            if (this.selected.length == 0) msg = msg + "Seleccione un miembro<br>";
            if (this.validateF_i == false) msg = msg + "Debe ingresar la fecha limite inferior <br>";
            if (this.validateF_f == false) msg = msg + "Debe ingresar la fecha limite superior<br>";
            if (this.fec_f <this.fec_i ) msg = msg + "El limite de la fecha seperior debe ser mayor<br>";

            if (msg == '') {
                this.generate();
            } else {
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-center">' + msg + '</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            }
        }
    },

    computed: {
        validateF_i(){
            return (this.fec_i != null);
        },
        validateF_f(){
            return (this.fec_f != null);
        },
        rows() {
            return this.items.length
        },
    }
}
</script>
