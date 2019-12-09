<template>
<div>
    <b-col cols="7">
        <label>Subgéneros</label>
        <b-table ref="selectableTable" selectable :select-mode="'multi'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="lg">
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
    <p>
        Selected Rows:<br>
        {{ selected }}
    </p>
</div>
</template>

<script>
export default {
    data() {
        return {
            fields: ['seleccionado', 'nombre' , 'id_subg'],
            items: [{
                    nombre: 'Uno',
                    id_subg: 1
                },
                {
                    nombre: 'Dos',
                    id_subg: 1
                },
                {
                    nombre: 'Tres',
                    id_subg: 1
                },
                {
                    nombre: 'Cinco',
                    id_subg: 1
                }
            ],
            selected: []
        }
    },

    methods: {
        onRowSelected(items) {
            this.selected = items
        },
    }
}
</script>
