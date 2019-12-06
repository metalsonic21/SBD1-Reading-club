<template>
<div>
    <div id="add-structure">
        <b-row>
            <b-col cols="6">
                <h6><strong>MODIFICAR ESTRUCTURA</strong></h6>
            </b-col>
        </b-row>
        <br>
        <b-row>
            <b-col cols="4">
                <label for="nombre">Nombre</label>
                <b-form-input type="text" v-model="nombre" id="nombre" name="nombre" placeholder="Nombre"></b-form-input>
            </b-col>

            <b-col cols="4">
                <label for="tipo">Tipo</label>
                <b-form-select v-model="tipo" :options="tipos" id="tipo" name="tipo"></b-form-select>
            </b-col>

            <b-col cols="4">
                <label for="titulo">Título</label>
                <b-form-input type="text" v-model="titulo" id="titulo" name="tipo"></b-form-input>
            </b-col>
        </b-row>
    </div>

</div>
</template>

<script>
export default {

}
</script>
