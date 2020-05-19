<template>
    <div class="row">
        <div class="col-md-12 mt-4">
            <ingreso-diario-reserva />
            <ingreso-mensual-reserva />
        </div>
    </div>
</template>

<script>
import ingresoDiarioReserva from "./IngresoDiarioReservas.vue";
import ingresoMensualReserva from "./IngresoMensualReservas.vue";

export default {
    components: {
        ingresoDiarioReserva,
        ingresoMensualReserva
    },
    mounted() {
        this.$Progress.finish();
    }
};
</script>
