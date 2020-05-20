<template>
    <div>
        <div class="text-center"></div>
        <h3
            class="profile-username text-center "
            v-text="caja.cajaActiva == 1 ? 'Caja activa' : 'Caja cerrada'"
        ></h3>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Fecha y hora de apertura:</b>
                <a class="float-right">
                    {{ caja.created_at | formatDateTimeComplete }}</a
                >
            </li>
            <li class="list-group-item" v-show="caja.horaCierre">
                <b>Fecha y hora de cierre:</b>
                <a class="float-right"> {{ caja.horaCierre }}</a>
            </li>
            <li class="list-group-item">
                <b>Monto de apertura:</b>
                <a class="float-right">{{ caja.montoApertura }}</a>
            </li>
            <li class="list-group-item" v-show="caja.montoCierre">
                <b>Monto de apertura:</b>
                <a class="float-right">{{ caja.montoCierre }}</a>
            </li>
            <li class="list-group-item">
                <b>Encargado:</b>
                <a class="float-right"> {{ caja.name }}</a>
            </li>
            <li class="list-group-item">
                <b>Saldo:</b>
                <a class="float-right"> {{ caja.saldo }}</a>
            </li>
            <li class="list-group-item">
                <b>Ganancia:</b>
                <a class="float-right">
                    {{ caja.saldo - caja.montoApertura }}</a
                >
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
ul li {
    font-size: 18px;
}
table {
    text-align: center;
}
.card {
    color: white;
}

.card p {
    text-align: center;
}
.list-group-item {
    background: rgba(52, 58, 64, 1);
}
</style>
