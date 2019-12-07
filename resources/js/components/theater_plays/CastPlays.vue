<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">theaters</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Obras acutuadas por club</h4>
                                </div>
                                <div class="col-lg-2">
                                    <b-link  href="/castplays/PlaysCreate" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Agregar Nueva Obra
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="text-center">Seleccione una obra</h6>
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Obras de teatro</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Todos los hijos de mis padres</td>
                                                    <td class="td-actions text-center">
                                                    <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.details-plays> Detalles 
                                                        </button>
                                                    <button type="button" rel="tooltip" class="btn btn-default" v-b-modal.days-plays> Presentaciones 
                                                        </button> 
                                                    <b-link href="/charactercast"> <button type="button" rel="tooltip" class="btn btn-default"> Ver Elenco 
                                                        </button></b-link>
                                                
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <b-modal size="lg" id="details-plays" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">movie</i>
                </div>
                <h4 class="card-title">Todos los hijos de mis padres</h4>
            </div>
            <div class="card-body ">
                <b-form>
                    <h2>Resumen:</h2>
                    <p align="justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt eos facere quo consectetur, nemo necessitatibus, iure perferendis vero libero neque velit eius veritatis quis? Neque error voluptas, eius veniam ullam a modi delectus iusto labore reiciendis minus optio corrupti repellat exercitationem fugit sint quas id saepe sequi perspiciatis vitae vero voluptatum voluptates unde. Velit totam iste fuga. Quis quam, laborum tenetur quas commodi omnis facilis dicta reprehenderit assumenda at expedita numquam molestias tempore. Molestiae velit quasi magnam dolores labore praesentium doloremque laboriosam vitae magni autem expedita architecto, quisquam dicta saepe incidunt nemo. Quae perferendis illum dolores provident saepe esse voluptatum</p>
                </b-form>
            </div>
            <div >
                <table class="table">
                        <tr>
                            <td>Duracion obra:</td>
                            <td>2000 min</td>
                        </tr>
                        <tr>
                             <td>Costo boleto:</td>
                             <td>150$</td>
                        </tr>
                </table>
            </div>
        </div>
    </b-modal>

    <b-modal size="lg" id="days-plays" ok-variant="default" ok-title="Continuar" cancel-title="Cancelar" cancel-variant="danger">
        <div class="card ">
            <div class="card-header card-header-log card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">movie</i>
                </div>
                <h4 class="card-title">Presentaciones:</h4>
                <h5 class="card-title">Todos los hijos de mis padres</h5>
            </div>
            <div >
                <table class="table">
                    <tr>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Disponibilidad</th>
                        <th># asistentes</th>
                        <th>Valoración</th>
                    </tr>
                    <tr>
                        <td>15/10/2019</td>
                        <td>20:00</td>
                        <td>No disponible</td>
                        <td>72</td>
                        <td>4/5</td>
                    </tr>
                    <tr>
                        <td>14/01/2020</td>
                        <td>17:00</td>
                        <td>Disponible</td>
                        <td>No disponible</td>
                        <td>No disponible</td>
                    </tr>
                    <tr>
                        <td>15/01/2020</td>
                        <td>17:00</td>
                        <td>Disponible</td>
                        <td>No disponible</td>
                        <td>No disponible</td>
                    </tr>
                </table>                
            </div>
            <p><b>Direccion de la presentacion:</b></p>
            <p>p sherman, calle wallaby 42, sidney</p>
        </div>       
    </b-modal>



</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>