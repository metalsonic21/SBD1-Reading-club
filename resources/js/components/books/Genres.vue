<template>
<div>
    <b-row>
        <b-col cols="6">
            <label>Subgéneros</label>
        </b-col>
    </b-row>
    <b-row>
        <b-col cols="12">
            <b-table ref="selectableTable" selectable :select-mode="'multi'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="md">
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
</div>
</template>

<script>
export default {
    data() {
        return {
            fields: ['seleccionado', 'nombre', 'tipo', 'subgenero'],
            items: [{
                    nombre: 'Uno',
                    tipo: '1',
                    subgenero: 'Dos',
                },
                {
                    nombre: 'Dos',
                    tipo: '2',
                    subgenero: 'Tres'
                },
                {
                    nombre: 'Tres',
                    tipo: '3',
                    subgenero: 'Cinco',
                },
                {
                    nombre: 'Cinco',
                    tipo: '3',
                    subgenero: 'Dos'
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
