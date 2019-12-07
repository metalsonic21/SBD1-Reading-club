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
                                    <h4 class="card-title">Añadir nuevo libro</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="isbn">ISBN</label>
                                                <b-form-input type="text" v-model="book.isbn" id="isbn" name="isbn"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="titulo_ori">Título Original</label>
                                                <b-form-input type="text" v-model="book.titulo_ori" id="titulo_ori" name="titulo_ori"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="titulo_esp">Título en Español</label>
                                                <b-form-input type="text" v-model="book.titulo_esp" id="titulo_esp" name="titulo_esp"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="tema_princ">Tema principal</label>
                                                <b-form-textarea type="text" v-model="book.tema_princ" id="tema_princ" name="tema_princ"></b-form-textarea>
                                            </b-col>

                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="12">
                                                <label for="sinop">Sinopsis</label>
                                                <b-form-textarea v-model="book.sinop" size="lg" rows="8" id="sinop" name="sinop"></b-form-textarea>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="n_pag">Número de páginas</label>
                                                <b-form-input v-model="book.n_pag" id="n_pag" name="n_pag"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="fec_pub">Fecha de publicación</label>
                                                <b-form-input type="date" v-model="book.fec_pub" id="fec_pub" name="fec_pub"></b-form-input>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="editorial">Editorial</label>
                                                <b-form-select v-model="book.editorial" :options="editoriales" id="editorial" name="editorial"></b-form-select>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>

                                            <b-col cols="6">
                                                <label for="prev">Predecesor</label>
                                                <b-form-input v-model="book.prev" id="prev" name="prev"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <hr>

                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>ESTRUCTURA</strong></h6>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="12">
                                                <div class="table-responsive table-sales">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Tipo</th>
                                                                <th class="text-center">Título</th>
                                                                <th class="text-center">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center">Prólogo</td>
                                                                <td class="text-center">Capítulo</td>
                                                                <td class="text-center">¿Qué es esto?</td>
                                                                <td class="td-actions text-center">
                                                                    <b-button @click="showAddForm" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Añadir" class="btn btn-info">
                                                                        <i class="material-icons">add</i>
                                                                    </b-button>
                                                                    <b-button @click="showEditForm" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" class="btn btn-success">
                                                                        <i class="material-icons">edit</i>
                                                                    </b-button>
                                                                    <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>GÉNEROS Y SUBGÉNEROS</strong></h6>
                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="genero">Genero</label>
                                                <b-form-select v-model="genero" :options="generos" id="genero" name="genero"></b-form-select>
                                            </b-col>
                                        </b-row>
                                        <br>

                                        <genres></genres>
                                        <hr>

                                        <div id="add-structure" v-if="wants_to_add">
                                            <b-row>
                                                <b-col cols="6">
                                                    <h6><strong>AÑADIR ESTRUCTURA</strong></h6>
                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="nombre">Nombre</label>
                                                    <b-form-input type="text" v-model="nombre" id="nombre" name="nombre" placeholder="Nombre"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="tipo">Tipo</label>
                                                    <b-form-select v-model="tipo" :options="tipos" id="tipo" name="tipo"></b-form-select>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="titulo">Título</label>
                                                    <b-form-input type="text" v-model="titulo" id="titulo" name="tipo"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <div class="d-flex flex-row-reverse bd-highlight">
                                                <b-button variant="default" @click="hideAddForm">Continuar</b-button>
                                            </div>
                                        </div>
                                        <div id="edit-structure" v-if="wants_to_edit">
                                            <b-row>
                                                <b-col cols="6">
                                                    <h6><strong>MODIFICAR ESTRUCTURA</strong></h6>
                                                </b-col>
                                            </b-row>
                                            <br>
                                            <b-row>
                                                <b-col cols="4">
                                                    <label for="nombre">Nombre</label>
                                                    <b-form-input type="text" v-model="nombre" id="nombre" name="nombre" placeholder="Nombre"></b-form-input>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="tipo">Tipo</label>
                                                    <b-form-select v-model="tipo" :options="tipos" id="tipo" name="tipo"></b-form-select>
                                                </b-col>

                                                <b-col cols="4">
                                                    <label for="titulo">Título</label>
                                                    <b-form-input type="text" v-model="titulo" id="titulo" name="tipo"></b-form-input>
                                                </b-col>
                                            </b-row>
                                            <div class="d-flex flex-row-reverse bd-highlight">
                                                <b-button variant="default" @click="hideEditForm">Continuar</b-button>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="add">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/books">Cancelar</b-link>
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
            books: [],
            book: {
                isbn: null,
                titulo_ori: null,
                titulo_esp: null,
                tema_princ: null,
                sinop: null,
                n_pag: null,
                subg: null,
                fec_pub: null,
                editorial: null,
                prev: null,
            },
            subgeneros: [{
                value: null,
                text: 'Seleccionar'
            }],
            editoriales: [{
            }],
            wants_to_add: false,
            wants_to_edit: false,
            nombre: null,
            tipo: null,
            tipos: [{
                value: null,
                text: 'Seleccionar'
            }],
            titulo: null,
        }
    },

    created(){
        axios.get('/books/create')
            .then(res => {
                this.editoriales = res.data.data;
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {

    /* ADD OR HIDE STRUCTURE FORM*/

        showAddForm() {
            this.wants_to_add = true;
            this.wants_to_edit = false;
            return this.wants_to_add;
        },
        hideAddForm() {
            this.wants_to_add = false;
            return this.wants_to_add;
        },
        showEditForm() {
            this.wants_to_edit = true;
            this.wants_to_add = false;
            return this.wants_to_edit;
        },
        hideEditForm() {
            this.wants_to_edit = false;
            return this.wants_to_edit;
        },

    /* CRUD BOOKS */
        add() {
            const params = {
                isbn: this.book.isbn,
                titulo_ori: this.book.titulo_ori,
                titulo_esp: this.book.titulo_esp,
                tema_princ: this.book.tema_princ,
                sinop: this.book.sinop,
                n_pag: this.book.n_pag,
                //subg: this.book.subg,
                subg: 'Prueba',
                fec_pub: this.book.fec_pub,
                editorial: this.book.editorial,
                prev: this.book.prev,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };

            console.log(params);

            this.book.isbn = '';
            this.book.titulo_ori = '';
            this.book.tema_princ = '';
            this.book.titulo_esp = '';
            this.book.n_pag = '';
            this.book.subg = '';
            this.book.fec_pub = '';
            this.book.editorial = '';
            this.book.prev = '';

            axios.post('/books', params)

                .then(res => {
                    alert('Libro añadido con éxito');
                    console.log(res.data);
                    //this.books.push(res.data)
                }).catch(e => {
                    console.log(e);
                })
        },
    }
}
</script>

<style>

</style>
