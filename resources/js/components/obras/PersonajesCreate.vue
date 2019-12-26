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
                                    <h4 class="card-title">Agregar personaje</h4>
                                </div>
                                <div class="col-lg-2">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <b-form>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Nombre</label>
                                                <b-form-input type="text" v-model="personaje.nom" id="nom" name="nom" placeholder="Nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El nombre del personaje no puede estar vacío ni tener más de 40 caracteres</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>

                                        <br>

                                        <b-row>
                                            <b-col cols="6">
                                                <label for="nom">Descripción</label>
                                                <b-form-textarea type="text" v-model="personaje.descrip" id="resumen" name="resumen" placeholder="Resumen"></b-form-textarea>
                                                <b-form-invalid-feedback :state="validateD">La descripción del personaje no puede tener más de 100 caracteres ni estar vacío</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                    </b-form>
                                    <br>

                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <b-button variant="default" @click="revalidate">Continuar</b-button>
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
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            personaje: {
                nom: null,
                descrip: null,
            },
        obra: null,
        }
    },

    methods: {
        add(){
            this.obra = window.location.pathname;
            this.obra = this.obra.replace(/\D/g, '');

            const params = {
                nom: this.personaje.nom,
                descrip: this.personaje.descrip,
                obra: this.obra,
            };

            axios.post(`/obras/${this.obra}/personajes`, params)
            .then(res => {
                console.log(res.data);
                window.location = `/obras/${this.obra}/personajes`;
            }).catch(e => {
                console.log(e);
            })

            console.log(params);
        },
        revalidate(){
            let msg = '';
                if (this.validateN == null) msg = msg + "El nombre de personaje no puede estar vacío<br>";
                if (this.validateN == false) msg = msg + "El nombre de personaje no puede tener más de 40 caracteres<br>";
                if (this.validateD == null) msg = msg + "La descripción de personaje no puede estar vacía<br>";
                if (this.validateD == false) msg = msg +  "La descripción de personaje no puede tener más de 500 caracteres<br>";
            if (msg == ''){
                this.add();
            }
            else {
                Swal.fire({
                    title: 'Error',
                    html: '<p class="text-left">' + msg + '</p>',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#8C7F7F',
                })
            }
        }
    },
    computed: {
        validateN(){
            if (this.personaje.nom == null || this.personaje.nom == '') return null;
            if (this.personaje.nom.length > 40) return false;
            else return true;
        },
        validateD(){
            if (this.personaje.descrip == null || this.personaje.descrip == '') return null;
            if (this.personaje.descrip.length > 500) return false;
            else return true;
        }
    }

}
</script>
