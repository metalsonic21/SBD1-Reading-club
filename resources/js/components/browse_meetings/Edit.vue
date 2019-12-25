<template>
<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">description</i>
            </div>
            <h4 class="card-title">Finalizar reunión</h4>
        </div>
        <div class="card-body ">
            <b-form @submit.prevent="add">
                <div id="conclusiones">
                    <b-row>
                        <b-col cols="12">
                            <h6><strong>CONCLUSIONES</strong></h6>
                            <small>Si agrega conclusiones a este campo se da por finalizada la reunión de este libro, sólo agregue conclusiones si está segur@ de que es la última sesión debido a que esta operación es irreversible</small>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col cols="12">
                            <label for="conclusion"></label>
                            <b-form-textarea v-model="meeting.conclusion" id="conclusion" name="conclusion"></b-form-textarea>
                            <b-form-invalid-feedback :state="validateC">El campo conclusión no puede superar los 1000 caracteres</b-form-invalid-feedback>
                        </b-col>
                    </b-row>
                    <br>
                    <b-row>
                        <b-col cols="6">
                            <label for="valoracion">Valoración</label>
                            <b-form-select v-model="meeting.valoracion" id="valoracion" :options="valoraciones" name="valoracion"></b-form-select>
                            <b-form-invalid-feedback :state="validateV">Por favor, rellene este campo</b-form-invalid-feedback>
                        </b-col>
                    </b-row>
                </div>

                <div class="d-flex flex-row-reverse bd-highlight">
                    <b-button variant="default" @click="revalidate">Continuar</b-button>
                </div>
            </b-form>
        </div>
    </div>
</div>
</template>

<script>
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'titulo_en_español', 'titulo_original', 'fecha_de_publicacion', 'autor'],
            meeting: {
                valoracion: null,
                conclusion: null,
                sesion: null,
                moderador: null,
            },
            miembros: [{
                value: null,
                text: 'Seleccionar'
            }],
            valoraciones: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: 1,
                    text: '1'
                },
                {
                    value: 2,
                    text: '2'
                },
                {
                    value: 3,
                    text: '3'
                },
                {
                    value: 4,
                    text: '4'
                },
                {
                    value: 5,
                    text: '5'
                }
            ],
            club: null,
            grupo: null,
            reunion: null,
            moderador: null,
            libro: null,
            actuals: null,
        }
    },
    created() {
        var path = window.location.pathname;
        let beginc = path.indexOf("bs/") + 3;
        let endc = path.indexOf("/gr");

        this.club = path.substring(beginc, endc);

        let beging = path.indexOf("ups/") + 4;
        let endg = path.indexOf("/mee");

        this.grupo = path.substring(beging, endg);

        let begin4 = path.indexOf("gs/") + 3;
        let partial = path.substring(begin4, path.length);
        this.reunion = partial.substring(0, partial.indexOf("/"));

        let partial2 = partial.substring(partial.indexOf("/") + 1, partial.length);
        this.moderador = partial2.substring(0, partial2.indexOf("/"));

        let partial3 = partial2.substring(partial2.indexOf("/") + 1, partial2.length);
        this.libro = partial3.substring(0, partial3.indexOf("/"));

        //console.log('clubs: '+this.club+' grupo: '+this.grupo+' reunion: '+this.reunion+' moderador: '+this.moderador+' libro: '+this.libro);

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/meetings/${this.reunion}/${this.moderador}/${this.libro}/edit`)
            .then(res => {
                this.actuals = res.data.actuals;
                //console.log(res.data.nsession);
            }).catch(e => {
                console.log(e);
            })
    },
    computed: {
        validateC() {
            if (this.meeting.conclusion == null || this.meeting.conclusion == '') return null;
            if (this.meeting.conclusion.length>1000) return false;
            else return true;
        },
        validateV() {
            return (this.meeting.valoracion != null);
        }
    },
    methods: {
        add() {
            const params = {
                conclusion: this.meeting.conclusion,
                valoracion: this.meeting.valoracion,

                club: this.club,
                grupo: this.grupo,
                libro: this.libro,
                moderador: this.moderador,
                ses: this.actuals,
            };

            axios.put(`/clubs/${this.club}/groups/${this.grupo}/meetings/${this.reunion}/${this.moderador}/${this.libro}`, params)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate() {
            let msg = '';
            if (this.validateC == null) msg = msg + "Por favor, escriba una conclusión<br>";
            if (this.validateC == false) msg = msg + "El campo conclusión no puede superar los 1000 caracteres<br>";
            if (!this.validateV) msg = msg + "Seleccione valoración<br>";

            if (msg == '') {
                Swal.fire({
                    title: '¿Estás seguro de esta acción?',
                    text: "No podrás revertirla!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#8C7F7F',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.value) {
                        this.add();
                    }
                })

            } else {
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
