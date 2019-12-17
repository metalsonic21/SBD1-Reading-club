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
                                    <h4 class="card-title">Editar personaje</h4>
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
export default {
    data() {
        return {
            personaje: {
                nom: null,
                descrip: null,
            },
        obra: null,
        actpersonaje: null,
        }
    },

    created(){
        let path = window.location.pathname;
        let begino = path.indexOf("ras/")+4;
        let endo = path.indexOf("/per");

        this.obra = path.substring(begino,endo);
        
        let path2 = path.substring(endo+1,path.length);
        
        let beginp = path2.indexOf("/");
        let endp = path2.indexOf("/edit");

        this.actpersonaje = path2.substring(beginp+1,endp);
        console.log(this.actpersonaje);
        axios.get(`/obras/${this.obra}/personajes/${this.actpersonaje}/edit`)
            .then(res => {
                this.personaje = res.data.data;
                //window.location = `/obras/${this.obra}/personajes`;
            }).catch(e => {
                console.log(e);
            })
    },

    methods: {
        add(){
            const params = {
                nom: this.personaje.nom,
                descrip: this.personaje.descrip,
                obra: this.obra,
            };
            
            axios.put(`/obras/${this.obra}/personajes/${this.actpersonaje}`, params)
            .then(res => {
                console.log(res.data);
                window.location = `/obras/${this.obra}/personajes`;
            }).catch(e => {
                console.log(e);
            })

        },
        revalidate(){
            let msg = '';
            if (this.personaje.nom == false || this.personaje.nom == null) msg = msg + "El nombre de personaje no puede estar vacío ni tener más de 40 caracteres\n";
            if (this.personaje.descrip == false || this.personaje.descrip == null) msg = msg +  "La descripción de personaje no puede estar vacía ni tener más de 500 caraceteres\n";

            if (msg == ''){
                this.add();
            }
            else {
                alert(msg);
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
