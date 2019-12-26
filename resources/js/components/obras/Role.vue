<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Agregar rol</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <b-form>
                                        <b-row>
                                            <b-col cols="6">
                                                <label for="character">Personaje</label>
                                                <b-form-select v-model="role.personaje" :options="personajes"></b-form-select>
                                                <small v-if="isThereAnyCharacter() == false">No hay personajes disponibles, para agregar un nuevo personaje a la obra presione <a v-bind:href="'/obras/'+obra+'/personajes/create'">aquí</a></small>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="actor">Actor</label>
                                                <b-form-select v-model="role.actor" :options="actores"></b-form-select>
                                            </b-col>
                                        </b-row>
                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>VALORACIÓN E IMPORTANCIA</strong></h6>
                                            </b-col>
                                        </b-row>
                                        <br>

                                        <b-row>
                                            <b-col cols="6">
                                                <label for="best">¿Fue el mejor actor?</label>
                                                <b-form-select v-model="role.best" :options="yesno"></b-form-select>
                                            </b-col>

                                            <b-col cols="6">
                                                <label for="main">¿Es un personaje principal?</label>
                                                <b-form-select v-model="role.main" :options="yesno"></b-form-select>
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

</div>
</template>

<script>
import Swal from 'sweetalert2';
export default {
    data() {
        return {
            club: null,
            fec: null,
            obra: null,
            local: null,

            actores: [{}],
            personajes: [{}],

            role: {
                actor: null,
                personaje: null,
                best: null,
                main: null,
            },

            yesno: [{
                    value: null,
                    text: 'Seleccionar'
                },
                {
                    value: true,
                    text: 'Sí'
                },
                {
                    value: false,
                    text: 'No'
                }
            ],
        }
    },
    created() {
        var path = window.location.pathname;
        let beginc = path.indexOf("bs/") + 3;
        let endc = path.indexOf("/pr");

        this.club = path.substring(beginc, endc);

        let path2 = path.substring(endc + 1, path.length);
        let beginf = path2.indexOf("/") + 1;
        let endf = path2.lastIndexOf("-") + 3;

        this.fec = path2.substring(beginf, endf);

        let path3 = path2.substring(endf + 1, path2.length);

        let endl = path3.indexOf("/");
        this.obra = path3.substring(0, endl);

        let path4 = path3.substring(endl + 1, path3.length);

        this.local = path4.replace(/\D/g, '');

        //console.log('club: '+this.club+' fecha: '+this.fec+' obra: '+this.obra+' local: '+this.local);

        axios.get(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast/create`)
            .then(res => {
                this.actores = res.data.actores;
                this.personajes = res.data.personajes;
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {
        isThereAnyCharacter(){
            return (this.personajes.length != 0);
        },
        add(){
            const params = {
                personaje: this.role.personaje,
                actor: this.role.actor,
                best: this.role.best,
                main: this.role.main,
            };

            axios.post(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast`, params)
            .then(res => {
                window.location = `/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/cast`;
            }).catch(e => {
                console.log(e);
            })

            //console.log(params);
        },
        revalidate() {
            let msg = '';
            if (this.role.personaje == null) msg = msg + "Seleccione un personaje<br>";
            if (this.role.actor == null) msg = msg + "Seleccione un actor<br>";
            if (this.role.best == null) msg = msg + "Especifique si el personaje fue el mejor o no<br>";
            if (this.role.main == null) msg = msg + "Especifique si el personaje fue principal o no<br>";

            if (msg == '') {
                this.add();
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
