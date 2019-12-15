<template>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-log card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">list</i>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="card-title">Lista de libros favoritos para {{member.nom1}} {{member.ape1}}</h4>
                            </div>
                            <div class="col-lg-2">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <b-form @submit.prevent="add">

                                    <b-table selectable :select-mode="'multi'" :items="items" :fields="fields" @row-selected="onRowSelected" id="my-table" :per-page="perPage" :current-page="currentPage" small>
                                        <template v-slot:cell(seleccionado)="{ rowSelected }">
                                            <template v-if="rowSelected && selected.length<=3">
                                                <span aria-hidden="true">&check;</span>
                                                <span class="sr-only">Seleccionado</span>
                                            </template>
                                            <template v-else>
                                                <span aria-hidden="true">&nbsp;</span>
                                                <span class="sr-only">No seleccionado</span>
                                            </template>
                                        </template>
                                    </b-table>

                                    <b-row>
                                        <b-col cols="8">
                                            <h6>NIVEL DE PREFERENCIA</h6>
                                            <small>1 el más alto, 3 el más bajo</small>
                                        </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col cols="4">
                                            <label for="prefOne">Preferencia para <em v-if="selected[0]">{{selected[0].titulo_en_español}}</em> </label>
                                            <b-form-select v-model="prefOne" :options="preferencias" id="prefOne" name="prefOne"></b-form-select>
                                            <b-form-invalid-feedback :state="validateOne">Debe seleccionar una preferencia y esta debe ser distinta a las demás seleccionadas</b-form-invalid-feedback>
                                        </b-col>

                                        <b-col cols="4">
                                            <label for="prefTwo">Preferencia para <em v-if="selected[1]">{{selected[1].titulo_en_español}}</em></label>
                                            <b-form-select v-model="prefTwo" :options="preferencias" id="prefTwo" name="prefTwo"></b-form-select>
                                            <b-form-invalid-feedback :state="validateTwo">Debe seleccionar una preferencia y esta debe ser distinta a las demás seleccionadas</b-form-invalid-feedback>

                                        </b-col>

                                        <b-col cols="4">
                                            <label for="prefThree">Preferencia para <em v-if="selected[2]">{{selected[2].titulo_en_español}}</em></label>
                                            <b-form-select v-model="prefThree" :options="preferencias" id="prefThree" name="prefThree"></b-form-select>
                                            <b-form-invalid-feedback :state="validateThree">Debe seleccionar una preferencia y esta debe ser distinta a las demás seleccionadas</b-form-invalid-feedback>

                                        </b-col>
                                    </b-row>
                                    <br>

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
</template>

<script>
export default {
    data() {
        return {
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'titulo_en_español', 'titulo_original', 'fecha_de_publicacion', 'autor'],
            items: [

            ],
            selected: [],
            prefOne: null,
            prefTwo: null,
            prefThree: null,
            preferencias: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 1,
                    text: '1'
                }, {
                    value: 2,
                    text: '2'
                },
                {
                    value: 3,
                    text: '3'
                }
            ],
            member: {},
        }
    },
    created() {
        var path = window.location.pathname;
        var isbn = path.indexOf("/clubs", 0) + 7;
        var isbnend = path.indexOf("/members", 0);
        var id = path.substring(isbn, isbnend);
        id = parseInt(id, 10);
        var newpath = path.substring(isbnend, path.length);
        newpath = newpath.replace(/\D/g, '');
        var ide = parseInt(newpath, 10);

        axios.get(`/clubs/${id}/members/${ide}/favorites`)
            .then(res => {
                this.items = res.data.data;
                this.member = res.data.member;
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        rows() {
            return this.items.length
        },
        validateOne() {
            if (this.prefOne != null)
                if (this.prefOne != this.prefTwo && this.prefOne != this.prefThree){
                    return true;
                }
                else return false;
            else return null;
        },
        validateTwo() {
            if (this.prefTwo != null)
                if (this.prefTwo != this.prefOne && this.prefTwo != this.prefThree)
                    return true;
                else return false;
            else return null;
        },

        validateThree() {
            if (this.prefThree != null)
                if (this.prefOne != this.prefTwo && this.prefOne != this.prefThree)
                    return true;
                else return false;
            else return null;
        },
    },

    methods: {
        onRowSelected(items) {
            if (this.selected.length < 3)
                this.selected = items
            else alert("Puedes seleccionar sólo tres libros\n");
        },

        add() {
            var path = window.location.pathname;
            var isbn = path.indexOf("/clubs", 0) + 7;
            var isbnend = path.indexOf("/members", 0);
            var id = path.substring(isbn, isbnend);
            id = parseInt(id, 10);
            var newpath = path.substring(isbnend, path.length);
            newpath = newpath.replace(/\D/g, '');
            var ide = parseInt(newpath, 10);
            const params = {
                selectedone: this.selected[0].isbn,
                selectedtwo: this.selected[1].isbn,
                selectedthree: this.selected[2].isbn,
                prefOne: this.prefOne,
                prefTwo: this.prefTwo,
                prefThree: this.prefThree,
                member: ide,
            }

            console.log(params);

            axios.post(`/clubs/${id}/members/${ide}/favorites`, params)
                .then(res => {
                    window.location = `/clubs/${id}/members`;

                    console.log(res.data);
                }).catch(e => {
                    console.log(e);
                })
        },

        validateSelect() {
            if (this.selected.length > 2) {
                if (!this.validateOne || !this.validateTwo || !this.validateThree)
                    alert("Debe seleccionar una preferencia y esta debe ser distinta a las demás seleccionadas\n");
                if (this.validateOne == null || this.validateTwo == null || this.validateThree == null)
                    alert("Por favor rellene todas las preferencias\n");
                else
                    this.add();
            } else {
                alert("Seleccione tres libros favoritos\n");
            }
        },
    }
}
</script>
