<template>
    <div class="row">
        <div class="col-md-12 mt-4">
            <ingresos-diarios />
            <ingreso-diario-reserva />
            <ingreso-mensual-reserva />
            <producto-stock />
            <caja-saldo />
        </div>
    </div>
</template>

<script>
import productoStock from "./ProductoStock.vue";
import cajaSaldo from "./CajaSaldo.vue";
import ingresoDiarioReserva from "./IngresoDiarioReservas.vue";
import ingresoMensualReserva from "./IngresoMensualReservas.vue";
import IngresosDiarios from "./IngresosDiarios.vue";

export default {
    components: {
        productoStock,
        cajaSaldo,
        ingresoDiarioReserva,
        ingresoMensualReserva,
        IngresosDiarios
    },
    mounted() {
        this.$Progress.finish();
    }
};
</script>
