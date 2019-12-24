<template>
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
                                <h4 class="card-title">Añadir lector existente a club</h4>
                            </div>
                            <div class="col-lg-2">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="overflow-auto">

                                    <b-form @submit.prevent="add">
                                        <b-col lg="6" class="my-1">
                                            <b-form-group label-for="filterInput" class="mb-0">
                                                <b-input-group size="sm">
                                                    <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Escribe para buscar"></b-form-input>
                                                    <b-input-group-append>
                                                        <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
                                                    </b-input-group-append>
                                                </b-input-group>
                                            </b-form-group>
                                        </b-col>
                                        <b-table selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="lg" id="my-table" :per-page="perPage" :current-page="currentPage" small sort-by="apellido" :filter="filter" :filterIncludedFields="filterOn" @filtered="onFiltered">
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

                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table"></b-pagination>

                                        </div>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="validateSelect">Continuar</b-button>
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
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'documento_de_identidad', 'nombre', 'apellido', 'fecha_de_nacimiento'],
            items: [

            ],
            selected: [],
            filterOn: [],
            filter: null,
        }
    },
    created() {
        var path = window.location.pathname;
        path = path.replace(/\D/g, '');

        axios.get(`/clubs/${path}/freeagent`)
            .then(res => {
                this.items = res.data.freeagents;
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        rows() {
            return this.items.length
        }
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

        add() {
            var path = window.location.pathname;
            path = path.replace(/\D/g, '');
            const params = {
                selected: this.selected[0].documento_de_identidad,
            }

            axios.put(`/clubs/${path}/freeagent/${params.selected}`, params)
                .then(res => {
                    window.location = `/clubs/${path}/members`;

                    console.log(res.data);
                }).catch(e => {
                    console.log(e);
                })
        },

        validateSelect() {
            if (this.selected.length > 0) {
                var path = window.location.pathname;
                path = path.replace(/\D/g, '');
                axios.get(`/clubs/${path}/freeagent/${this.selected[0].documento_de_identidad}/verify`)
                    .then(res => {
                        //window.location = `/clubs/${path}/members`;
                        if (res.data.length == 0) {
                            this.add();
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Este miembro ya fue añadido al club hoy, intente de nuevo mañana',
                                icon: 'error',
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#8C7F7F',
                            })
                        }
                        //console.log(res.data);
                    }).catch(e => {
                        console.log(e);
                    })

            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Seleccione un lector para agregar',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            }
        },
    }
}
</script>
