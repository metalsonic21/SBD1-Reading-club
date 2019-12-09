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
                                    <h4 class="card-title">Editar Capítulo/Sección</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form @submit.prevent="revalidate">
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="nombre">Nombre</label>
                                                <b-form-input type="text" v-model="struct.nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">Nombre de estructura no puede estar vacío</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="tipo">Tipo</label>
                                                <b-form-select v-model="struct.tipo" :options="tipos" id="tipo" name="tipo"></b-form-select>
                                                <b-form-invalid-feedback :state="validateT">Tipo de estructura no puede estar vacío</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="titulo">Título</label>
                                                <b-form-input type="text" v-model="struct.titulo" id="titulo" name="tipo"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>DATOS DE LA SECCIÓN</strong></h6>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="num">Número</label>
                                                <b-form-input type="text" v-model="struct.num" id="num" name="num"></b-form-input>
                                                <b-form-invalid-feedback :state="validateNUM">Número de sección debe ser dato numérico</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="secnom">Nombre de la sección</label>
                                                <b-form-input type="text" v-model="struct.secnom" id="secnom" name="secnom"></b-form-input>
                                                <b-form-invalid-feedback :state="validateSN">Nombre de la sección no puede estar vacío</b-form-invalid-feedback>
                                            </b-col>
                                            
                                            <b-col cols="4">
                                                <label for="sectitulo">Título de la sección</label>
                                                <b-form-input type="text" v-model="struct.sectit" id="sectitulo" name="sectitulo"></b-form-input>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <b-button variant="default" @click="revalidate">Continuar</b-button>
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
    data(){
        return{
            struct: {
                titulo: '',
                tipo: '',
                nom: '',
                secnom: '',
                sectit: '',
                num: '',
            },

            tipos:[{
                value: null,
                text: 'Seleccionar',
            },
            {
                value: 'C',
                text: 'Capítulo'
            },
            {
                value: 'O',
                text: 'Otro'
            }],
        }
    },

    computed:{
        validateN(){
            return (this.struct.nom != '');
        },

        validateT(){
            return (this.struct.tipo != null);
        },

        validateSN(){
            return (this.struct.secnom != '');
        },
        validateNUM(){
            if (this.struct.num == '') return false;
            return (this.struct.num != null && !isNaN(this.struct.num) && this.struct.num < 99999);
        }
    },

    created(){
        var path = window.location.pathname;
        var isbn = path.indexOf("k")+3;
        var isbnend = path.indexOf("t")-2;
        var id = path.substring(isbn,isbnend);
        id = parseInt(id,10);
        var newpath = path.substring(isbnend,path.length);
        newpath = newpath.replace(/\D/g, '');
        var ide = parseInt(newpath,10);

        axios.get(`/books/${id}/structure/${ide}/edit`)
            .then(res => {
                this.struct.titulo = res.data.data[0].structit;
                this.struct.tipo = res.data.data[0].tipo;
                this.struct.nom = res.data.data[0].structname;

                this.struct.secnom = res.data.data[0].nom;
                this.struct.sectit = res.data.data[0].titulo;
                this.struct.num = res.data.data[0].num;

                console.log(res.data.data);
            }).catch(e => {
                console.log(e);
            })

    },

    methods:{
        update(){
            var path = window.location.pathname;
            var isbn = path.indexOf("k")+3;
            var isbnend = path.indexOf("t")-2;
            var id = path.substring(isbn,isbnend);
            id = parseInt(id,10);
            var newpath = path.substring(isbnend,path.length);
            newpath = newpath.replace(/\D/g, '');
            var ide = parseInt(newpath,10);
                
            const params = {
                tipo: this.struct.tipo,
                titulo: this.struct.titulo,
                nom: this.struct.nom,
                secnom: this.struct.secnom,
                num: this.struct.num,
                sectit: this.struct.sectit,
            };

            this.struct.tipo = '';
            this.struct.titulo = '';
            this.struct.nom = '';
            this.struct.num = 0,
            this.struct.sectit = '',
            this.struct.secnom = '',
            console.log(params);
            axios.put(`/books/${id}/structure/${ide}`, params)
                .then(res => {
                    window.location = `/books/${id}/structure`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate(){
            let msg = '';
            if (!this.validateN) msg = msg + "El campo Nombre de Estructura no puede estar vacío\n";
            if (!this.validateT) msg = msg + "El campo Tipo de Estructura no puede estar vacío\n";
            if (!this.validateSN) msg = msg + "El campo Nombre de Sección no puede estar vacío\n"; 
            if (!this.validateNUM) msg = msg + "El campo Número de Sección debe ser numérico\n";

            if (msg==''){
                this.update();
            }
            else{
                alert(msg);
            }
        }
    }
}
</script>
