<template>
    <div>
        <div class="text-center"></div>
        <h3 class="profile-username text-center">Datos del cliente</h3>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Nombre y apellido:</b>
                <a class="float-right">{{
                    cliente.nombre + " " + cliente.apellido
                }}</a>
            </li>
            <li class="list-group-item">
                <b>DNI:</b>
                <a class="float-right">{{ cliente.dni }}</a>
            </li>
            <li class="list-group-item" v-show="cliente.celular">
                <b>Celular:</b>
                <a class="float-right"> {{ cliente.celular }}</a>
            </li>
            <li class="list-group-item" v-show="cliente.domicilio">
                <b>Domicilio:</b>
                <a class="float-right"> {{ cliente.domicilio }}</a>
            </li>
            <li class="list-group-item" v-show="cliente.rofecion">
                <b>Profecion:</b>
                <a class="float-right"> {{ cliente.profecion }}</a>
            </li>
            <li class="list-group-item" v-show="cliente.tipoFactura">
                <b>Factura:</b>
                <a class="float-right"> {{ cliente.tipoFactura }}</a>
            </li>
            <li class="list-group-item" v-show="cantidadReservas">
                <b>Cantidad de reservas del cliente:</b>
                <a class="float-right"> {{ cantidadReservas }}</a>
            </li>
            <li class="list-group-item">
                <b>Fecha y hora que se agrego:</b>
                <a class="float-right">
                    {{ cliente.created_at | formatDateTimeComplete }}</a
                >
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ["cliente", "cantidadReservas"]
};
</script>
<style scoped>
ul li {
    font-size: 17px;
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
