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
                                    <h4 class="card-title">Modificar obra</h4>
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
                                                <h6 class="ml-3"><strong>LISTA DE LIBROS</strong></h6>
                                                <small class="ml-3">Seleccione el libro en el que va a estar relacionada esta obra</small>
                                            </b-col>
                                        </b-row>

                                        <b-row>
                                            <b-col cols="12">
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
                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Nombre</label>
                                                <b-form-input type="text" v-model="obra.nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El nombre de la obra no puede estar vacío ni tener más de 40 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>

                                        <br>

                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Resumen</label>
                                                <b-form-textarea type="text" v-model="obra.resum" id="resumen" name="resumen" placeholder="Resumen"></b-form-textarea>
                                                <b-form-invalid-feedback :state="validateR">El resumen no puede estar vacío ni tener más de 200 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
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
            obra: {
                nom: null,
                resum: null,
                lib: null,
            },
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'titulo_en_español', 'titulo_original', 'fecha_de_publicacion', 'autor'],
            items: [],
            selected: [],
            filterOn: [],
            filter: null,
            id: null,
        }
    },

    created() {
        this.id = window.location.pathname;
        this.id = this.id.replace(/\D/g, '');
        axios.get(`/obras/${this.id}/edit`)
            .then(res => {
                this.items = res.data.data;
                this.obra = res.data.obra;
                //this.obra.nom = res.data.obra.nom;
                //this.obra.resum = res.data.obra.resum;
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
        add(){
            const params = {
                nom: this.obra.nom,
                resum: this.obra.resum,
                libro: this.selected[0].isbn,
            };

            axios.put(`/obras/${this.id}`, params)
            .then(res => {
                //console.log(res.data);
                window.location = "/obras";
            }).catch(e => {
                console.log(e);
            })

            console.log(params);
        },
        revalidate(){
            let msg = '';
            if (this.obra.nom == null) msg = msg + "El nombre de obra no puede estar vacío<br>";
            if (this.obra.nom == false) msg = msg + "El nombre de obra no puede tener más de 40 caracteres<br>";
            if (this.obra.resum == null) msg = msg + "El resumen de obra no puede estar vacío<br>";
            if (this.obra.resum == false) msg = msg + "El resumen de obra no puede tener más de 200 caraceteres<br>";
            if (this.selected.length == 0) msg = msg + "Seleccione un libro<br>";

            if (msg == ''){
                this.add();
            }
            else {
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-left">' + msg + '</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            }
        }
    },
    computed: {
        rows() {
            return this.items.length
        },
        validateN(){
            if (this.obra.nom == null || this.obra.nom == '') return null;
            if (this.obra.nom.length > 40) return false;
            else return true;
        },
        validateR(){
            if (this.obra.resum == null || this.obra.resum == '') return null;
            if (this.obra.resum.length > 200) return false;
            else return true;
        }
    }

}
</script>
