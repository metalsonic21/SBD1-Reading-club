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
                                    <h4 class="card-title">Reportes por club</h4>
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
                                                    <th class="text-center">Nombre de club</th>
                                                    <th class="text-center">Reportes disponibles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Killer Bees</td>

                                                    <td class="td-actions text-center">
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Libros analizados por este club" class="btn btn-danger" v-b-modal.view-club>
                                                            <i class="material-icons">comment</i> Libros analizados
                                                        </button>
                                                        <button type="button" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Ficha club" class="btn btn-default" v-b-modal.view-club>
                                                            <i class="material-icons">book</i> Ficha club
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