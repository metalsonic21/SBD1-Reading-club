<template>
<div>
    <b-modal size="lg" id="add-meeting" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">Datos reunión</h4>
            </div>
            <div class="card-body ">
                <b-form>
                    <b-row>
                        <b-col cols="6">
                            <label for="mod">Moderador</label>
                            <b-form-select v-model="moderador" :options="miembros" id="mod" name="mod"></b-form-select>
                        </b-col>

                        <b-col cols="6">
                            <label for="session">Sesión</label>
                            <b-form-select v-model="sesion" :options="sesiones" id="session" name="session"></b-form-select>
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
                            <b-table ref="selectableTable" selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="sm">
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
                                <b-form-textarea v-model="conclusion" id="conclusion" name="conclusion"></b-form-textarea>
                            </b-col>
                        </b-row>
                        <br>
                        <b-row>
                            <b-col cols="6">
                                <label for="valoracion">Valoración</label>
                                <b-form-select v-model="valoracion" id="valoracion" :options="valoraciones" name="valoracion"></b-form-select>
                            </b-col>
                        </b-row>
                    </div>
                </b-form>
            </div>
        </div>
    </b-modal>

</div>
</template>

<script>
export default {
    data() {
        return {
            fields: ['seleccionado', 'documento_de_identidad', 'primer_nombre', 'primer_apellido', 'fecha_de_nacimiento'],
            items: [{
                    documento_de_identidad: 123456789101112,
                    primer_nombre: 'Leo',
                    primer_apellido: 'Barnes',
                    fecha_de_nacimiento: '01-01-1992'
                },
                {
                    documento_de_identidad: 121110987654321,
                    primer_nombre: 'Frank',
                    primer_apellido: 'Hesse',
                    fecha_de_nacimiento: '02-02-1993'
                },
                {
                    documento_de_identidad: 98765432112110,
                    primer_nombre: 'Thomas',
                    primer_apellido: 'Leonhardt',
                    fecha_de_nacimiento: '03-03-1993'
                },
                {
                    documento_de_identidad: 5678912345111011,
                    primer_nombre: 'Stephan',
                    primer_apellido: 'Schonlau',
                    fecha_de_nacimiento: '04-04-1993',
                }
            ],
            selected: [],
            valoracion: null,
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
            },{
                value: 4,
                text: '4'
            },
            {
                value: 5,
                text: '5'
            }],
            conclusion: null,
            moderador: null,
            miembros: [{
                value: null,
                text: 'Seleccionar'
            }],
            sesion: null,
            sesiones:[{
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
            }]
        }
    },
    methods: {
        onRowSelected(items) {
            this.selected = items
        },
    }
}
</script>
