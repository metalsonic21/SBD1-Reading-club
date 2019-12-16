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
                                    <h4 class="card-title">Modificar presentación</h4>
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
                                            <b-col cols="12">
                                                <b-row>
                                                    <b-col cols="6">
                                                        <h6 class="ml-3"><strong>LISTA DE OBRAS</strong></h6>
                                                        <small class="ml-3">Seleccione la obra en el que va a estar relacionada esta presentación</small>
                                                    </b-col>
                                                </b-row>

                                                <b-row>
                                                    <b-col cols="12">
                                                        <b-col lg="6" class="my-1">
                                                            <b-form-group label-for="filterInput" class="mb-0">
                                                                <b-input-group size="sm">
                                                                    <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Escribe para buscar"></b-form-input>
                                                                    <b-input-group-append>
                                                                        <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
                                                                    </b-input-group-append>
                                                                </b-input-group>
                                                            </b-form-group>
                                                        </b-col>
                                                        <b-table selectable :select-mode="'single'" :items="items" :fields="fields" @row-selected="onRowSelected" responsive="lg" id="my-table" :per-page="perPage" :current-page="currentPage" small sort-by="apellido" :filter="filter" :filterIncludedFields="filterOn" @filtered="onFiltered">
                                                            <!-- Example scoped slot for select state illustrative purposes -->
                                                            <template v-slot:cell(seleccionado)="{ rowSelected }">
                                                                <template v-if="rowSelected">
                                                                    <span aria-hidden="true">&check;</span>
                                                                    <span class="sr-only">Seleccionado</span>
                                                                </template>
                                                                <template v-else>
                                                                    <span aria-hidden="true">&nbsp;</span>
                                                                    <span class="sr-only">No seleccionado</span>
                                                                </template>
                                                            </template>
                                                        </b-table>
                                                    </b-col>
                                                </b-row>
                                                <div class="d-flex flex-row-reverse bd-highlight">
                                                    <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table"></b-pagination>

                                                </div>

                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="local">Local</label>
                                                <b-form-select v-model="presentacion.ubicacion" :options="locales" name="local"></b-form-select>
                                                <b-form-invalid-feedback :state="validateL">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="costo">Costo de la entrada ($)</label>
                                                <b-form-input type="text" v-model="presentacion.costo" name="costo" placeholder="Costo"></b-form-input>
                                                <b-form-invalid-feedback :state="validateC">El costo debe ser un número positivo</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="valoracion">Valoración</label>
                                                <b-form-select v-model="presentacion.valor" :options="valoraciones"></b-form-select>
                                                <b-form-invalid-feedback :state="validateV">* Requerido</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>
                                        <br>
                                        <b-row>
                                            <b-col cols="4">
                                                <label for="n_asist">Número de asistentes</label>
                                                <b-form-input type="text" v-model="presentacion.num_asist" name="n_asist" placeholder="Número de asistentes"></b-form-input>
                                                <b-form-invalid-feedback :state="validateN">El número de asistentes debe ser un número entero positivo</b-form-invalid-feedback>
                                            </b-col>
                                        </b-row>

                                        <hr>
                                        <b-row>
                                            <b-col cols="6">
                                                <h6><strong>DURACIÓN Y FECHA</strong></h6>
                                            </b-col>
                                        </b-row>

                                        <b-row>
                                            <b-col cols="4">
                                                <label for="fecha">Fecha</label>
                                                <b-form-input type="date" v-model="presentacion.fecha" name="fecha"></b-form-input>
                                                <b-form-invalid-feedback :state="validateF">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="4">
                                                <label for="hora_i">Hora de inicio</label>
                                                <b-form-input type="time" v-model="presentacion.hora_i" name="hora_i"></b-form-input>
                                                <b-form-invalid-feedback :state="validateH">* Requerido</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="2">
                                                <label for="durac">Duración (Horas)</label>
                                                <b-form-input type="text" v-model="presentacion.durac" name="durac"></b-form-input>
                                                <b-form-invalid-feedback :state="validateD">La duración en horas debe ser un número entero positivo entre 0 y 24</b-form-invalid-feedback>
                                            </b-col>

                                            <b-col cols="2">
                                                <label for="duracm">Duración (Minutos)</label>
                                                <b-form-input type="text" v-model="presentacion.duracm" name="duracm"></b-form-input>
                                                <b-form-invalid-feedback :state="validateDM">La duración en minutos debe ser un número entero positivo del 0 al 60</b-form-invalid-feedback>
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
            presentacion: {
                ubicacion: null,
                fecha: null,
                hora_i: null,
                durac: null,
                duracm: null,
                costo: null,
                local: null,
                obra: null,
                valor: null,
                num_asist: null,
            },
            perPage: 10,
            currentPage: 1,
            fields: ['seleccionado', 'nombre_de_obra', 'libro', 'resumen'],
            items: [],
            selected: [],
            filterOn: [],
            filter: null,
            locales: [],
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
            local: null,
            fec: null,
            obra: null,
            prevlocal: null,
            prevdate: null,
            prevobra: null,
        }
    },

    created() {
        var path = window.location.pathname;
        let beginc = path.indexOf("bs/")+3;
        let endc = path.indexOf("/pr");

        this.club = path.substring(beginc,endc);

        let path2 = path.substring(endc+1,path.length);
        //console.log(path2);
        let beginf = path2.indexOf("/")+1;
        let endf = path2.lastIndexOf("-")+3;

        this.fec = path2.substring(beginf,endf);

        let path3 = path2.substring(endf+1,path2.length);

        let endl = path3.indexOf("/");
        this.obra = path3.substring(0,endl);

        let path4 = path3.substring(endl+1,path3.length);

        this.local = path4.replace(/\D/g, '');
        
        //console.log('club: '+this.club+' fecha: '+this.fec+' obra: '+this.obra+' local: '+this.local);

        axios.get(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}/edit`)
            .then(res => {
                this.items = res.data.data;
                this.locales = res.data.locales;
                this.presentacion = res.data.presentacion;
                this.prevdate = this.presentacion.fecha;
                this.prevobra = this.presentacion.obra;
                this.prevlocal = this.presentacion.ubicacion;
                console.log(this.prevdate);
            }).catch(e => {
                console.log(e);
            })
    },
    methods: {

        onRowSelected(items) {
            this.selected = items
        },

        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        add() {
            const params = {
                obra: this.selected[0].id,
                local: this.presentacion.ubicacion,
                costo: this.presentacion.costo,
                asist: this.presentacion.num_asist,
                valor: this.presentacion.valor,
                fecha: this.presentacion.fecha,
                horai: this.presentacion.hora_i,
                durac: this.presentacion.durac,
                duracm: this.presentacion.duracm,
                prevdate: this.prevdate,
                prevlocal: this.prevlocal,
                prevobras: this.prevobra,
                
                club: this.club,

            };

            console.log(params);

            axios.put(`/clubs/${this.club}/presentaciones/${this.fec}/${this.obra}/${this.local}`, params)
                .then(res => {
                    //console.log(res.data);
                    window.location = `/clubs/${this.club}/presentaciones`;
                }).catch(e => {
                    console.log(e);
                })
        },

        revalidate() {
            let msg = '';
            if (!this.validateS) msg = msg + "Debe seleccionar una obra que estará relacionada con la presentación\n";
            if (!this.validateL) msg = msg + "Debe seleccionar un local\n";
            if (!this.validateV) msg = msg + "Debe seleccionar una valoración para la presentación\n";
            if (!this.validateC || this.validateC == null) msg = msg + "Campo costo no puede estar vacío, debe ser un número entero positivo no demasiado grande\n";
            if (!this.validateF) msg = msg + "Debe seleccionar una fecha para la presentación\n";
            if (!this.validateH) msg = msg + "El campo hora inicio de presentación no puede estar vacío\n";
            if (!this.validateD || this.validateD == null) msg = msg + "El campo duración en horas debe ser un número entero positivo de el 0 al 23\n";
            if (!this.validateDM || this.validateDM == null) msg = msg + "El duración en minutos debe ser un número entero positivo de el 0 al 59\n";
            if (!this.validateN || this.validateN == null) msg = msg + "El campo número de asistentes debe ser un número entero positivo\n";
            if (this.presentacion.durac == 0 && this.presentacion.duracm == 0) msg = msg + "Rellene una duración para la presentación\n";
            if (msg == '') {
                this.add();
            } else {
                alert(msg);
            }
        }
    },

    computed: {

        rows() {
            return this.items.length
        },
        validateS() {
            return (this.items.length > 0);
        },
        validateL() {
            return (this.presentacion.ubicacion != null);
        },
        validateV() {
            return (this.presentacion.valor != null);
        },
        validateC() {
            if (this.presentacion.costo == null || this.presentacion.costo == '') return null;
            if (this.presentacion.costo < 9999999 && this.presentacion.costo > 0 && !isNaN(this.presentacion.costo)) return true;
            else return false;
        },
        validateF() {
            return (this.presentacion.fecha != null);
        },
        validateH() {
            return (this.presentacion.hora_i != null);
        },
        validateD() {
            if (this.presentacion.durac == null || this.presentacion.durac == '') return null;
            if (this.presentacion.durac < 24 && this.presentacion.durac >= 0 && this.presentacion.durac.toString().indexOf(".") == -1 && !isNaN(this.presentacion.durac)) return true;
            else return false;
        },
        validateDM() {
            if (this.presentacion.duracm == null || this.presentacion.duracm == '') return null;
            if (this.presentacion.duracm <= 59 && this.presentacion.duracm >= 0 && this.presentacion.duracm.toString().indexOf(".") == -1 && !isNaN(this.presentacion.duracm)) return true;
            else return false;
        },
        validateN() {
            if (this.presentacion.num_asist == null || this.presentacion.num_asist == '') return null;
            if (!isNaN(this.presentacion.num_asist) && this.presentacion.num_asist > 0 && this.presentacion.num_asist.toString().indexOf(".") == -1 && this.presentacion.num_asist < 9999999) return true;
            else return false;
        },
    }

}
</script>
