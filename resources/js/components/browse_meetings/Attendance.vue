<template>
<div>

    <b-modal size="lg" id="attendance" ok-variant="default" cancel-variant="danger" ok-title="Actualizar" cancel-title="Cerrar">
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
                        <tr>
                            <td class="text-center">Frank</td>
                            <td class="text-center">Hesse</td>
                            <td class="td-actions text-center">
                                <b-form-select v-model="asistencia" id="asistencia" name="asistencia" :options="asistencias"></b-form-select>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    data(){
        return{
            asistencia: false,
            asistencias: [{
                value: false,
                text: 'No'
            },
            {
                value: true,
                text: 'Sí'
            }]
        }
    }
}
</script>
