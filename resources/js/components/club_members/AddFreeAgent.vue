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
                                    <h4 class="card-title">Añadir lector existente a club</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="add">

                                        <b-table ref="selectableTable" selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="lg">
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
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="validateSelect">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/browseclubs">Cancelar</b-link>
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
            fields: ['seleccionado', 'documento_de_identidad', 'nombre', 'apellido', 'fecha_de_nacimiento'],
            items: [{
                documento_de_identidad: 123456,
                nombre: 'Uno',
                apellido: 'Dos',
                fecha_de_nacimiento: '08-08-2019'

            }],
            selected: {},

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
    methods: {
        onRowSelected(items) {
            this.selected = items
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
                this.add();
            } else {
                alert("Seleccione un lector para agregar\n");
            }
        },

    }
}
</script>

<style>

</style>
