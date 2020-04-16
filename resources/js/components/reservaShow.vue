<template>
    <div>
        id numero:{{ reserva.id }} <br />
        pagado:{{ reserva.pagado }}
        <br />
        total a pagar:{{ reserva.totalPagar }}
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    props: ["id"],
    created() {
        this.$store.dispatch("fetchReserva", this.id);
    },
    computed: mapState(["reserva"])
};
</script>
