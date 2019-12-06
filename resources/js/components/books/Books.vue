<template>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-log card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">library_books</i>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <h4 class="card-title">Explorar libros</h4>
                                </div>
                                <div class="col-lg-2">

                                    <b-link  href="/books/create" class="btn btn-default float-right mt-3">
                                        <span class="btn-label">
                                            <i class="material-icons">add</i>
                                        </span>
                                        Crear libro
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Título en español</th>
                                                    <th class="text-center">Título original</th>
                                                    <th class="text-center">Editorial</th>
                                                    <th class="text-center">Fecha de publicación</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">No tengo tiempo para leer</td>
                                                    <td class="text-center">No me sé ningún título xd</td>
                                                    <td class="text-center">Ola</td>
                                                    <td class="text-center">08-08-1997</td>
                                                    <td class="td-actions text-center">
                                                        <b-link href="/books/show" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Visualizar" class="btn btn-info" v-b-modal.view-book>
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </b-link>
                                                        <b-link href="/books/1/edit" type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Modificar" v-b-modal.edit-book class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </b-link>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
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

</div>
</template>

<script>
export default {

}
</script>

<style>

</style>
