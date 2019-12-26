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
                                    <h4 class="card-title">Editar local</h4>
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
                                                <label for="">Nombre</label>
                                                <b-form-input type="text" v-model="local.nom" placeholder="Nombre"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El campo nombre de local no puede estar vacío ni tener más de 15 caracteres</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="tipo">Tipo</label>
                                                <b-form-select v-model="local.tipo" :options="tipos"></b-form-select>
                                                <b-form-invalid-feedback :state="validateT">* Requerido</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="">Capacidad</label>
                                                <b-form-input placeholder="Capacidad" v-model="local.cap"></b-form-input>
                                                <b-form-invalid-feedback :state="validateC">El campo capacidad debe ser un número entero positivo</b-form-invalid-feedback>
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
            local: {
                nom: null,
                tipo: null,
                cap: null,
            },
            tipos:[{
                value: null,
                text: 'Seleccionar'
            },
            {
                value: 'S',
                text: 'Sala'
            },
            {
                value: 'A',
                text: 'Auditorio'
            }],
            club: null,
            actual: null,
        }
    },
    computed:{
        validateN(){
            if (this.local.nom == null || this.local.nom == '') return null;
            if (this.local.nom.length >15 ) return false;
            else return true;
        },
        validateT(){
            return (this.local.tipo != null);
        },
        validateC(){
            if (this.local.cap == null || this.local.cap == '') return null;
            if (!isNaN(this.local.cap) && this.local.cap > 0 && this.local.cap < 999999 && this.local.cap.toString().indexOf(".") == -1) return true;
            else return false;
        }
    },
    created(){
        let path = window.location.pathname;
        let beginc = path.indexOf("bs/")+3;
        let endc = path.indexOf("/lo");

        this.club = path.substring(beginc,endc);
        let path2 = path.substring(endc+1,path.length);

        let beginl = path2.indexOf("es/")+3;
        let endl = path2.indexOf("/ed");

        this.actual = path2.substring(beginl,endl);
        axios.get(`/clubs/${this.club}/locales/${this.actual}/edit`)
            .then(res => {
                this.local = res.data.data;

            }).catch(e => {
                console.log(e);
            })
        

    },
    methods:{
        add(){
            const params = {
                nom: this.local.nom,
                tipo: this.local.tipo,
                cap: this.local.cap,
                club: this.club,
            };

        axios.put(`/clubs/${this.club}/locales/${this.actual}`,params)
            .then(res => {
                window.location = `/clubs/${this.club}/locales`;
                //console.log(res.data);
            }).catch(e => {
                console.log(e);
            })
        },
        revalidate(){
            let msg = '';

            if (this.validateN == null) msg = msg + "El campo Nombre de Local no puede estar vacío<br>";
            if (this.validateN == false) msg = msg + "El campo Nombre de Local no puede estar vacío ni tener más de 15 caracteres<br>";
            if (this.validateT == null) msg = msg + "El campo Tipo de Local no puede estar vacío<br>";
            if (this.validateC == null) msg = msg + "El campo Capacidad no puede estar vacío<br>";
            if (this.validateC == false) msg = msg + "El campo Capacidad debe ser un número entero positivo<br>";

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
    }
}
</script>
