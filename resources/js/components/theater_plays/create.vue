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
                                    <h4 class="card-title">Añadir Nueva Obra</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-row>
                                        <b-col cols="6">
                                            <label for="Nombre">Nombre</label>
                                            <b-form-input type="text" v-model="Nombre" id="nombre" name="nombre"></b-form-input>
                                        </b-col>
                                            <b-col cols="6  ">
                                            <label for="Nombre">Obra Base</label>
                                            <b-form-select v-model="selected" :options="options" ></b-form-select>
                                            <div class="mt-3">Selected: <strong>{{ selected }}</strong></div>
                                        </b-col>
                                    </b-row>
                                    <br>
                                    <b-row>
                                        <b-col cols="12">
                                            <label for="tema_princ">Resumen de la Obra</label>
                                            <b-form-textarea type="text" v-model="tema_princ" id="tema_princ" name="tema_princ"></b-form-textarea>
                                        </b-col>
                                    </b-row>
                                    <hr>
                                    <b-row>
                                        <b-col cols="7">
                                            <label for="Nombre">Lugar</label>
                                            <b-form-select v-model="selected2" :options="options2" ></b-form-select>
                                            <div class="mt-3">Selected: <strong>{{ selected2 }}</strong></div>
                                        </b-col>
                                        <b-col cols="5">
                                            <label for="n_pag">Costo de la entrada</label>
                                            <b-form-input v-model="costo" type=number id="costo" name="costo"></b-form-input>
                                        </b-col>
                                    </b-row>
                                    <br>
                                    <b-row>
                                                <b-col cols="6">
                                                <label for="fec_pub">Fecha de la presentación</label>
                                                <b-form-input type="date" v-model="fec_pre" id="fec_pre" name="fec_pre"></b-form-input>
                                                </b-col>
                                                <b-col cols="3">
                                                <label for="editorial">Hora Inicio: </label>
                                                <b-form-input v-model="time" type=time placeholder="Enter your name"></b-form-input>
                                                </b-col>
                                                <b-col cols="3">                                        
                                                <label for="editorial">Hora Fin: </label>
                                                <b-form-input v-model="time" type=time placeholder="Enter your name"></b-form-input>                                        
                                                </b-col>
                                    </b-row>
                                    <hr>
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <b-button variant="default" type="submit">Continuar</b-button>

                                        <b-link class="btn btn-danger" href="/castplays">Cancelar</b-link>
                                    </div>
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
            isbn: null,
            titulo_ori: null,
            titulo_esp: null,
            tema_princ: null,
            sinop: null,
            n_pag: null,
            subg: null,
            subgeneros: [{
                value: null,
                text: 'Seleccionar'
            }],
            fec_pub: null,
            editorial: null,
            editoriales: [{
                value: null,
                text: 'Seleccionar'
            }],
            prev: null,
            wants_to_add: false,
            wants_to_edit: false,
            nombre: null,
            tipo: null,
            tipos: [{
                value: null,
                text: 'Seleccionar'
            }],
            titulo: null,
            selected: null,
                options: [
                    { value: null, text: 'Por favor elija una obra base' },
                    { value: 'Novela 1', text: 'Novela 1' },
                    { value: 'Epica 1', text: 'Epica 1' },
                    { value: 'Narrativa 1', text: 'Narrativa 1' },
                    { value: 'Poemario 1', text: 'Poemario 1' },
                ],
                selected2: null,
                options2: [
                    { value: null, text: 'Por favor elija un lugar' },
                    { value: 'Petare', text: 'Petare' },
                    { value: 'Tierra de nadie 420', text: 'Tierra de nadie 420' },
                    { value: 'Grama de Letras UCAB', text: 'Grama de Letras UCAB' },
                    { value: 'Poemario 1', text: 'Poemario 1' }
                    ]
        }
    },
    methods: {
        showAddForm() {
            this.wants_to_add = true;
            this.wants_to_edit = false;
            return this.wants_to_add;
        },
        hideAddForm(){
            this.wants_to_add = false;
            return this.wants_to_add;
        },
        showEditForm(){
            this.wants_to_edit = true;
            this.wants_to_add = false;
            return this.wants_to_edit;
        },
        hideEditForm(){
            this.wants_to_edit = false;
            return this.wants_to_edit;
        }
    }
}
</script>

<style>

</style>
