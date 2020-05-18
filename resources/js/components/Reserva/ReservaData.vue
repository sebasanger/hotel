<template>
    <div>
        <div class="text-center"></div>
        <h4 class="profile-username text-center">
            Datos de la reserva
        </h4>

        <ul class="list-group list-group-unbordered mb-3 ">
            <li class="list-group-item ">
                <b>Numero de la habitacion:</b>
                <a class="float-right"> {{ reserva.numeroHabitacion }}</a>
            </li>
            <li class="list-group-item">
                <b>Precio por dia:</b>
                <a class="float-right">{{ reserva.precio }}</a>
            </li>
            <li
                class="list-group-item"
                :class="[
                    reserva.pagado >= reserva.totalPagar
                        ? 'text-green'
                        : 'text-red'
                ]"
            >
                <b>Total a pagar:</b>
                <a class="float-right"> {{ reserva.totalPagar }}</a>
            </li>
            <li
                class="list-group-item"
                :class="[
                    reserva.pagado >= reserva.totalPagar
                        ? 'text-green'
                        : 'text-red'
                ]"
            >
                <b>Total pagado:</b>
                <a class="float-right"> {{ reserva.pagado }}</a>
            </li>
            <li
                class="list-group-item"
                :class="[
                    reserva.pagado >= reserva.totalPagar
                        ? 'text-green'
                        : 'text-red'
                ]"
            >
                <b>Falta pagar:</b>
                <a class="float-right"> {{ faltante }}</a>
            </li>
            <li class="list-group-item">
                <b>Ingreso:</b>
                <a class="float-right">
                    {{ reserva.ingreso | formatDateComplete }}</a
                >
            </li>
            <li class="list-group-item">
                <b>Egreso:</b>
                <a class="float-right">
                    {{ reserva.egreso | formatDateComplete }}</a
                >
            </li>
            <li class="list-group-item">
                <b>Dias totales:</b>
                <a class="float-right"> {{ betWeen }}</a>
            </li>

            <li class="list-group-item" v-if="reserva.procedencia">
                <b>Procedencia del cliente:</b>
                <a class="float-right">
                    {{ reserva.procedencia | capitalize }}</a
                >
            </li>
            <li class="list-group-item" v-if="reserva.destino">
                <b>Destino del huesped:</b>
                <a class="float-right"> {{ reserva.destino | capitalize }}</a>
            </li>
            <li class="list-group-item" v-if="reserva.patenteAuto">
                <b>Patente del vehiculo</b>
                <a class="float-right"> {{ reserva.patenteAuto }}</a>
            </li>
        </ul>
    </div>
</template>
<script>
import moment from "moment";
export default {
    props: ["reserva"],
    computed: {
        betWeen() {
            var a = moment(this.reserva.egreso);
            var b = moment(this.reserva.ingreso);
            return a.diff(b, "days");
            //return moment().diff();
        },
        faltante() {
            return this.reserva.totalPagar - this.reserva.pagado;
        }
    }
};
</script>
<style scoped>
p {
    font-size: medium;
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
