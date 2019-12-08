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
                                    <h4 class="card-title">Añadir Nuevo Personaje</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-row>
                                        <b-col cols="10">
                                            <label for="Nombre">Obra</label>
                                            <b-form-select v-model="selected" :options="options" ></b-form-select>
                                            <div class="mt-3">Selected: <strong>{{ selected }}</strong></div>
                                        </b-col>
                                    </b-row>
                                    <br>
                                    <b-row>
                                    </b-row>


                                    <b-row>
                                        <b-col cols="10">
                                            <label for="n_pag">Personaje</label>
                                            <b-form-input v-model="personaje" id="personaje" name="personaje"></b-form-input>
                                        </b-col>
                                    </b-row>


                                    <b-row>
                                        <b-col cols="10">
                                            <label for="Nombre">Interprete</label>
                                            <b-form-select v-model="selected2" :options="options2" ></b-form-select>
                                            <div class="mt-3">Selected: <strong>{{ selected2 }}</strong></div>
                                        </b-col>
                                    </b-row>
                                    <b-row>
                                        <b-col cols="10">
                                            <label for="tema_princ">Descripción</label>
                                            <b-form-textarea type="text" v-model="tema_princ" id="tema_princ" name="tema_princ"></b-form-textarea>
                                        </b-col>
                                    </b-row>
                                    <br>                           

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
                    { value: null, text: 'Por favor elija un interprete' },
                    { value: 'Roberto Lopez', text: 'Roberto Lopez' },
                    { value: 'Karla Mata', text: 'Karla Mata' },
                    { value: 'Frak Martinez', text: 'Frak Martinez' }
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
