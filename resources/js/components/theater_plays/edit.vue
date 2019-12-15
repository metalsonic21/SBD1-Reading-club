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
                                    <h4 class="card-title">Modificar obra</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="add">
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="Nombre">Nombre</label>
                                                <b-form-input type="text" required v-model="nom" id="nombre" name="nombre"></b-form-input>
                                            </b-col>
                                                <b-col cols="6  ">
                                                <label for="Nombre">Obra Base</label>
                                                <b-form-select v-model="ObraBase" :options="libros" ></b-form-select>
                                                <div class="mt-3">ISBN: <strong>{{ ObraBase }}</strong></div>
                                            </b-col>
                                        </b-row>
                                        <b-row>

                                            <b-col cols="6">
                                                <label for="Nombre">resum</label>
                                                <b-form-input type="text" required v-model="resum" id="resum" name="resum"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" type="submit">Continuar</b-button>
                                            <b-link class="btn btn-danger" href="/castplays">Cancelar</b-link>
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
                            
                        id: '',
                        nom: '',
                        resum: '',
                        ob:'',
                        ObraBase: {'text':''},
                        libros: [{}],
    }
    },

    created() {
        var play = window.location.pathname;
        play = play.replace(/\D/g, '');
        axios.get(`/castplays/${play}/edit`)
            .then(res => {                        
                this.libros = res.data.libros;
                this.nom = res.data.play[0].nom;
                this.resum = res.data.play[0].resum;
                this.id = res.data.play[0].id;
                //this.ObraBase[0].value = res.data.value;
                this.ObraBase.text = res.data.text;
                console.log (res.data.text);
            }).catch(e => {
                console.log(e);
            })
    },

    computed: {
        validateISBN(){
            let isValid = null;
                if (this.book.isbn!='' && (this.book.isbn.length != 5 || isNaN(this.book.isbn) || this.book.isbn.indexOf(".")!=-1 || this.book.isbn<0)) isValid = false;
                else isValid = true;
            return isValid;
        },
        validateTO(){
            return (this.book.titulo_ori!='');
        },
        validateTE(){
            return (this.book.titulo_esp!='');
        },
        validateSinopsis(){
            return (this.book.sinop.length > 9);
        },
        validateNP(){
            let isValid = null;
                if (this.book.n_pag!=null && (isNaN(this.book.n_pag) || this.book.n_pag.indexOf(".")!=-1 || this.book.n_pag<0 || this.book.n_pag > 999999)) isValid = false;
                else isValid = true;
            return isValid;
        },
        validateF(){
            return (this.book.fec_pub != null);
        },
        validateA(){
            return(this.book.autor !='');
        },
        validateG(){
            return(this.book.genero != null);
        },
        validateSG(){
            return(this.book.subg != null);
        },
        validateE(){
            return(this.book.editorial != null);
        },
        validateP(){
            let verif = (this.libros.findIndex(isbn => isbn.isbn == this.book.prev)!=-1);
            let validPrev=null;
                if (this.book.prev!='' && (this.book.prev.length != 5 || isNaN(this.book.prev.isbn) || this.book.prev.indexOf(".")!=-1 || this.book.prev.isbn<0)) validPrev = false;
                else validPrev = true;
                if (this.book.prev == '')
                    return true;
            return ((this.book.prev != this.book.isbn && verif) || validPrev );

        }
    },
    methods: {

        /* ADD OR HIDE STRUCTURE FORM

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


        convert(id, length) {
            let pos = id.indexOf("-");
            let res = id.substring(pos + 1, length);
            parseInt(res, 10);
            return res;
        },

        filter() {
            /* Filter subgenres according to the genre
            this.subgeneros = [{}],
                this.subgenerosfiltered = [{}],
                this.book.subg = null,
                this.subgeneros = this.subgbackup;

            let i = 0;

            for (i = 0; i < this.subgeneros.length; i++) {
                /* Converted ID is id_sub
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
        },*/

        
/*
        revalidate(){
          let msg = '';
          let isValid = true;

            if (this.validateISBN == false) msg = msg + "El ISBN debe ser un campo numérico entero de al menos 5 caracteres\n";
            if (this.validateTO == false) msg = msg +  "El campo Título Original no puede estar vacío\n";
            if (this.validateTE == false) msg = msg + "El campo Título en Español no puede estar vacío\n";
            if (this.validateSinopsis == false) msg = msg + "El campo Sinopsis debe tener al menos 10 caracteres\n";
            if (this.validateNP == false) msg = msg + "El campo número de páginas debe ser numérico entero\n";
            if (this.validateF == false) msg = msg + "El campo Fecha de publicación no puede estar vacío\n";
            if (this.book.editorial == null) msg = msg + "El campo Editorial no puede estar vacío\n";
            if (this.book.genero == null) msg = msg + "El campo Genero no puede estar vacío\n";
            if (this.book.genero != null && this.book.subg == null) msg = msg + "El campo Subgénro no puede estar vacío\n";
            if (this.validateA == false) msg = msg + "El campo Autor no puede estar vacío\n";
            if (this.validateG == false) msg = msg + "El campo Género no puede estar vacío\n";
            if (this.validateSG == false) msg = msg + "El campo Subgénero no puede estar vacío\n";
            if (this.validateE == false) msg = msg + "El campo Editorial no puede estar vacío\n";
            if (this.validateP == false) msg = msg + "En el campo libro predecesor debe haber un ISBN válido\n";
            if (msg!=''){
                isValid = false;
                alert(msg);
            }
            else {
                this.add();
            }
        },

        /* CRUD BOOKS */
        add() {
            var play = window.location.pathname;
            play = play.replace(/\D/g, '');
            const params = {
                id:this.id,
                nom: this.nom,                
                resum: this.resum,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            };

            this.nom = '';
            this.ob = '';
            this.resum = '';
            axios.put(`/castplays/${play}`, params)
                .then(res => {
                    window.location = "/castplays";
                }).catch(e => {
                    console.log(e);
                })
        },
    }
}

</script>

<style>

</style>
