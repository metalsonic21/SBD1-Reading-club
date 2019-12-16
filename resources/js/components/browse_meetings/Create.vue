<template>
<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">add</i>
            </div>
            <h4 class="card-title">Generar reuniones</h4>
        </div>
        <div class="card-body ">
            <b-form @submit.prevent="add">
                <b-row>
                    <b-col cols="6">
                        <h6 class="ml-3"><strong>LISTA DE LIBROS</strong></h6>
                        <small class="ml-3">Seleccione el libro en el que va a estar relacionada esta reunión</small>
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
                        <label for="mod">Moderador</label>
                        <b-form-select v-model="meeting.moderador" :options="miembros" id="mod" name="mod"></b-form-select>
                        <b-form-invalid-feedback :state="validateM">Seleccione un moderador</b-form-invalid-feedback>
                    </b-col>

                    <b-col cols="6">
                        <label for="session">Número de sesiones</label>
                        <b-form-select v-model="meeting.sesion" :options="sesiones" id="session" name="session"></b-form-select>
                        <b-form-invalid-feedback :state="validateN">Seleccione el número de sesiones que durará esta reunión</b-form-invalid-feedback>
                    </b-col>
                </b-row>
                <hr>

                <div class="d-flex flex-row-reverse bd-highlight">
                    <b-button variant="default" @click="revalidate">Continuar</b-button>

                    <b-link class="btn btn-danger" href="/browseclubs">Cancelar</b-link>
                </div>
            </b-form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'titulo_en_español', 'titulo_original', 'fecha_de_publicacion', 'autor'],
            meeting: {
                valoracion: null,
                conclusion: null,
                sesion: null,
                moderador: null,
            },
            items: [{
                value: null,
                text: 'Seleccionar'
            }],
            miembros: [{
                value: null,
                text: 'Seleccionar'
            }],
            valoraciones: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 1,
                    text: '1'
                },
                {
                    value: 2,
                    text: '2'
                },
                {
                    value: 3,
                    text: '3'
                },
                {
                    value: 4,
                    text: '4'
                },
                {
                    value: 5,
                    text: '5'
                }
            ],
            sesiones: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 1,
                    text: '1'
                },
                {
                    value: 2,
                    text: '2'
                },
                {
                    value: 3,
                    text: '3'
                }
            ],
            selected: [],
            filterOn: [],
            filter: null,
            club: null,
            grupo: null,
        }
    },
    created() {
        var path = window.location.pathname;
        var isbn = path.indexOf("/clubs", 0) + 7;
        var isbnend = path.indexOf("/groups", 0);
        this.club = path.substring(isbn, isbnend);
        this.club = parseInt(this.club, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        this.grupo = parseInt(newpath, 10);

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/meetings/create`)
            .then(res => {
                this.miembros = res.data.data;
                this.items = res.data.libros;
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        rows() {
            return this.items.length
        },

        validateM() {
            return (this.meeting.moderador != null);
        },
        validateN() {
            return (this.meeting.sesion != null);
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
            const params = {
                moderador: this.meeting.moderador,
                conclusion: this.meeting.conclusion,
                sesion: this.meeting.sesion,
                valoracion: this.meeting.valoracion,

                /* BOOK */
                libro: this.selected[0].id,
                club: this.club,
                grupo: this.grupo,
            };

            axios.post(`/clubs/${this.club}/groups/${this.grupo}/meetings`, params)
                .then(res => {
                    if (this.meeting.sesion == 3)
                        alert("Se han generado las reuniones para el libro solicitado en los siguientes días\n" + res.data.f1 + "\n" + res.data.f2 + "\n" + res.data.f3 + "\n");
                    else if (this.meeting.sesion == 2)
                        alert("Se han generado las reuniones para el libro solicitado en los siguientes días\n" + res.data.f1 + "\n" + res.data.f2 + "\n");
                    else if (this.meeting.sesion == 1)
                        alert("Se han generado las reuniones para el libro solicitado en los siguientes días\n" + res.data.f1 + "\n");

                    window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate() {
            let msg = '';
            if (!this.validateN) msg = msg + "Seleccione el número de sesiones\n";
            if (!this.validateM) msg = msg + "Seleccione un moderador\n";

            if (msg == '') {
                this.add();
            } else {
                alert(msg);
            }
        }
    }

}
</script>
