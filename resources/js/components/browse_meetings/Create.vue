<template>
<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">add</i>
            </div>
            <h4 class="card-title">Generar reunión mensual</h4>
        </div>
        <div class="card-body ">
            <b-form>
                <b-row>
                    <b-col cols="6">
                        <label for="mod">Moderador</label>
                        <b-form-select v-model="meeting.moderador" :options="miembros" id="mod" name="mod"></b-form-select>
                    </b-col>

                    <b-col cols="6">
                        <label for="session">Sesión</label>
                        <b-form-select v-model="meeting.sesion" :options="sesiones" id="session" name="session"></b-form-select>
                    </b-col>
                </b-row>
                <hr>
                <b-row>
                    <b-col cols="6">
                        <h6><strong>LISTA DE LIBROS</strong></h6>
                        <small>Seleccione el libro en el que va a estar relacionada esta reunión</small>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col cols="12">
                        <b-table ref="selectableTable" id="my-table" selectable :select-mode="'single'" :items="items" :per-page="perPage" :current-page="currentPage" small :fields="fields" @row-selected="onRowSelected" responsive="sm">
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
                <p>
                    Selected Rows:<br>
                    {{ selected }}
                </p>
                <hr>
                <div id="conclusiones">
                    <b-row>
                        <b-col cols="6">
                            <h6><strong>CONCLUSIONES</strong></h6>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="12">
                            <label for="conclusion"></label>
                            <b-form-textarea v-model="meeting.conclusion" id="conclusion" name="conclusion"></b-form-textarea>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                        <b-col cols="6">
                            <label for="valoracion">Valoración</label>
                            <b-form-select v-model="meeting.valoracion" id="valoracion" :options="valoraciones" name="valoracion"></b-form-select>
                        </b-col>
                    </b-row>

                    <div class="d-flex flex-row-reverse bd-highlight">
                        <b-button variant="default" @click="add">Continuar</b-button>

                        <b-link class="btn btn-danger" href="/browseclubs">Cancelar</b-link>
                    </div>
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
    },
    methods: {
        onRowSelected(items) {
            this.selected = items
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
                    console.log(res.data);
                }).catch(e => {
                    console.log(e);
                })
        }
    }

}
</script>
