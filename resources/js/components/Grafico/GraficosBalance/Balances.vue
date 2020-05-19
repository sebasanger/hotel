<template>
    <div class="row">
        <div class="col-md-12 mt-4">
            <balance-diario />
            <balance-mensual />
        </div>
    </div>
</template>

<script>
import balanceDiario from "./BalanceDiario.vue";
import balanceMensual from "./BalanceMensual.vue";

export default {
    components: {
        balanceDiario,
        balanceMensual
    },
    mounted() {
        this.$Progress.finish();
    }
};
</script>
