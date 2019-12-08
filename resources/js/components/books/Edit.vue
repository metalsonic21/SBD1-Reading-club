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
                                    <h4 class="card-title">Editar libro</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <b-form @submit.prevent="update">
                                <div class="row">
                                    <div class="col-lg-12">
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
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>GÉNEROS Y SUBGÉNEROS</strong></h6>
                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="genero">Genero</label>
                                                <b-form-select v-model="book.genero" :options="generos" @change="filter()" id="genero" name="genero"></b-form-select>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="subg">Subgenero</label>
                                                <b-form-select v-model="book.subg" :options="subgeneros" id="subg" name="subg"></b-form-select>
                                            </b-col>

                                        </b-row>
                                        <br>

                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="update">Continuar</b-button>

                                            <b-link class="btn btn-danger" href="/books">Cancelar</b-link>
                                        </div>
                                    </div>

                                </div>
                            </b-form>
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
            book: {
                isbn: null,
                titulo_ori: null,
                titulo_esp: null,
                tema_princ: null,
                sinop: null,
                editorial: null,
                n_pag: null,
                fec_pub: null,
                genero: null,
                subg: null,
            },
            generos: [{
                value: null,
                text: 'Seleccionar'
            }],
            subgenerosfiltered: [{}],
            subgbackup: [{}],
            subgeneros: [{
                value: null,
                text: 'Seleccionar'
            }],
            editoriales: [{
                value: null,
                text: 'Seleccionar'
            }],
            prev: null,
        }
    },
    created() {
        var params = window.location.pathname;
        params = params.replace(/\D/g, '');
        //console.log(params);
        axios.get(`/books/${params}/edit`)
            .then(res => {
                this.book = res.data.data;
                this.editoriales = res.data.editoriales;
                this.book.editorial = res.data.data.id_edit;
                this.generos = res.data.generos;
                this.book.genero = res.data.currentg;
                this.subgbackup = res.data.subgeneros;
                this.book.subg = res.data.currentsubg;

                this.subgeneros = [{}];
                //console.log(this.subgbackup[1].value);

                var i = 0;
                for (i = 0; i < this.subgbackup.length; i++) {
                    let gid = this.subgbackup[i].value;
                    let posgid = gid.indexOf("-") + 1;
                    gid = gid.substr(posgid, gid.length);
                    gid = parseInt(gid, 10);
                    let sid = this.subgbackup[i].value;
                    sid = sid.substr(0, posgid);
                    sid = parseInt(sid, 10);
                    if (gid == this.book.genero) {
                        this.subgeneros.push({
                            value: sid,
                            text: this.subgbackup[i].text,
                        });
                    }
                }

                this.subgeneros[0].value = null;
                this.subgeneros[0].text = 'Seleccionar';

            }).catch(e => {
                console.log(e);
            })
    },
    methods: {

        convert(id, length) {
            let pos = id.indexOf("-");
            let res = id.substring(pos + 1, length);
            parseInt(res, 10);
            return res;
        },

        filter() {
            /* Filter subgenres according to the genre*/
            this.subgeneros = [{}],
                this.subgenerosfiltered = [{}],
                this.book.subg = null,
                this.subgeneros = this.subgbackup;

            let i = 0;

            for (i = 0; i < this.subgeneros.length; i++) {
                /* Converted ID is id_sub*/
                let convertedid = this.convert(this.subgeneros[i].value, this.subgeneros.length);
                if (this.book.genero == convertedid) {
                    let actualid = this.subgeneros[i].value.substring(0, this.subgeneros[i].value.indexOf("-"));
                    actualid = parseInt(actualid, 10);
                    this.subgenerosfiltered.push({
                        value: actualid,
                        text: this.subgeneros[i].text
                    });
                }
            }

            this.subgeneros = [{}];
            this.subgeneros = this.subgenerosfiltered;

            this.subgeneros[0].value = null;
            this.subgeneros[0].text = 'Seleccionar';
        },

        /* CRUD BOOKS */
        update() {
            const params = {
                isbn: this.book.isbn,
                titulo_ori: this.book.titulo_ori,
                titulo_esp: this.book.titulo_esp,
                tema_princ: this.book.tema_princ,
                sinop: this.book.sinop,
                autor: this.book.autor,
                n_pag: this.book.n_pag,
                genero: this.book.genero,
                subg: this.book.subg,
                fec_pub: this.book.fec_pub,
                editorial: this.book.editorial,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };

            this.book.isbn = '';
            this.book.titulo_ori = '';
            this.book.tema_princ = '';
            this.book.titulo_esp = '';
            this.book.autor = '';
            this.book.n_pag = '';
            this.book.genero = '';
            this.book.subg = '';
            this.book.fec_pub = '';
            this.book.editorial = '';

            var url = window.location.pathname;
            url = url.replace(/\D/g, '');
            console.log(params);
            axios.put(`/books/${url}`, params)
                .then(res => {
                    console.log(res.data);
                    //window.location = "/books";
                }).catch(e => {
                    console.log(e);
                })
        },
    }

}
</script>

<style>

</style>
