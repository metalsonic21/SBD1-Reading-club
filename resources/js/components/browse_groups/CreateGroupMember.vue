<template>
<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">add</i>
            </div>
            <h4 class="card-title">Añadir nuevo miembro</h4>
        </div>
        <div class="card-body ">
            <p>Seleccione un miembro del club para agregar al grupo</p>

            <b-form>
                <b-table ref="selectableTable" selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="sm" id="my-table" :per-page="perPage" :current-page="currentPage" small>
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
                    <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table"></b-pagination>

                </div>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <b-button variant="default" @click="add">Continuar</b-button>

                    <b-link class="btn btn-danger">Cancelar</b-link>
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
            fields: ['seleccionado', 'documento_de_identidad', 'primer_nombre', 'primer_apellido', 'fecha_de_nacimiento'],
            items: [{
                documento_de_identidad: 123456789101112,
                primer_nombre: 'Leo',
                primer_apellido: 'Barnes',
                fecha_de_nacimiento: '01-01-1992'
            }, ],
            selected: [],
            member: {},
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

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/gmembers/create`)
            .then(res => {
                this.items = res.data.data;
            }).catch(e => {
                console.log(e);
            })

        //console.log('id club '+this.club+' id grupo '+this.grupo );

    },
    methods: {
        onRowSelected(items) {
            this.selected = items
        },

        add(){
            this.member = this.selected[0];
            axios.put(`/clubs/${this.club}/groups/${this.grupo}/gmembers/${this.member.documento_de_identidad}`)
            .then(res => {
                //console.log(res.data);
                window.location = `/clubs/${this.club}/groups/${this.grupo}/gmembers`;
            }).catch(e => {
                console.log(e);
            })
        },
    },
    computed:{
        rows() {
            return this.items.length
        },
    }
}
</script>
