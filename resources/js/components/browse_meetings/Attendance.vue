<template>
<div>
    <div class="card ">
        <div class="card-header card-header-log card-header-icon">
            <div class="card-icon">
                <i class="material-icons">list</i>
            </div>
            <h4 class="card-title">Control de asistencia reunión</h4>
        </div>
        <div class="card-body ">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">¿Faltó a la reunión?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in members" :key="index">
                        <td class="text-center">{{item.nombre}}</td>
                        <td class="text-center">{{item.apellido}}</td>
                        <td class="td-actions text-center">
                            <b-form-select v-model="item.asist" id="asistencia" name="asistencia" :options="asistencias"></b-form-select>
                        </td>
                    </tr>

                </tbody>
            </table>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <b-button variant="default" @click="add">Continuar</b-button>

                        <b-link class="btn btn-danger" href="/browseclubs">Cancelar</b-link>
                    </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            asistencia: false,
            asistencias: [{
                    value: false,
                    text: 'No'
                },
                {
                    value: true,
                    text: 'Sí'
                }
            ],
            members: [],
            memberships: [],
            club: null,
            grupo: null,
            libro: null,
            moderador: null,
            reunion: null,
        }
    },
    created(){
        var path = window.location.pathname;
        let beginc = path.indexOf("bs/")+3;
        let endc = path.indexOf("/gr");

        this.club = path.substring(beginc,endc);

        let beging = path.indexOf("ups/")+4;
        let endg = path.indexOf("/mee");

        this.grupo = path.substring(beging,endg);
        

        let begin4 = path.indexOf("gs/")+3;
        let partial = path.substring(begin4,path.length);
        this.reunion = partial.substring(0,partial.indexOf("/"));

        let partial2 = partial.substring(partial.indexOf("/")+1,partial.length);
        this.moderador = partial2.substring(0,partial2.indexOf("/"));

        let partial3 = partial2.substring(partial2.indexOf("/")+1,partial2.length);
        this.libro = partial3.substring(0,partial3.indexOf("/"));

        axios.get(`/clubs/${this.club}/groups/${this.grupo}/meetings/${this.reunion}/${this.moderador}/${this.libro}/attendance`)
            .then(res => {
                this.members = res.data.data;
            }).catch(e => {
                console.log(e);
            })

    },

    methods:{
        add(){

            let i = 0
            let gdates = [];
            let cdates = [];
            let items = [];
            let att = [];

            for (i ; i<this.members.length ; i++){
                gdates[i] = this.members[i].fig;
                cdates[i] = this.members[i].fic;
                items[i] = this.members[i].id; 
                att[i] = this.members[i].asist;
            }

            console.log(items);
            const params = {
                items: items,
                gdates: gdates,
                cdates: cdates,
                att: att,
                length: this.members.length,
                club: this.club,
                grupo: this.grupo,
                libro: this.libro,
                reunion: this.reunion,
                moderador: this.moderador,
            }
        axios.post(`/clubs/${this.club}/groups/${this.grupo}/meetings/${this.reunion}/${this.moderador}/${this.libro}/attendance`,params)
            .then(res => {
                window.location = `/clubs/${this.club}/groups/${this.grupo}/meetings`;
                console.log(res.data);
            }).catch(e => {
                console.log(e);
            })

        }
    }
}
</script>
