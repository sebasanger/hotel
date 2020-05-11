<template>
    <div>
        <div class="text-center"></div>
        <h4 class="profile-username text-center">
            Datos de la caja
        </h4>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Fecha y hora de apertura:</b>
                <a class="float-right"> {{ caja.created_at }}</a>
            </li>
            <li class="list-group-item">
                <b>Monto de apertura:</b>
                <a class="float-right">{{ caja.montoApertura }}</a>
            </li>
            <li class="list-group-item">
                <b>Encargado:</b>
                <a class="float-right"> {{ caja.name }}</a>
            </li>
            <li class="list-group-item">
                <b>Saldo:</b>
                <a class="float-right"> {{ caja.saldo }}</a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ["caja"]
};
</script>
<style scoped>
b {
    font-size: medium;
}
a {
    font-size: medium;
}
</style>
