<template>
    <div>
        <p>nombre: {{ reserva.nombre + " " + reserva.apellido }}</p>
        <p>numero de la habitacion: {{ reserva.numeroHabitacion }}</p>

        <p>total a pagar: {{ reserva.totalPagar }}</p>

        <p>total pagado: {{ reserva.pagado }}</p>

        <p>Ingreso: {{ reserva.ingreso | formatDate }}</p>

        <p>Egreso: {{ reserva.egreso | formatDate }}</p>

        <p>Dias totales: {{ betWeen }}</p>

        <router-link :to="{ name: 'reserva' }">atras</router-link>
    </div>
</template>

<script>
import { mapState } from "vuex";
import moment from "moment";

export default {
    props: ["id"],
    created() {
        this.$store
            .dispatch("fetchReserva", this.id)
            .then(() => {
                this.$Progress.finish();
            })
            .catch(() => {
                this.$router.push({
                    name: "500"
                });
            });
    },
    computed: {
        ...mapState(["reserva"]),
        betWeen() {
            var a = moment(this.reserva.egreso);
            var b = moment(this.reserva.ingreso);
            return a.diff(b, "days");
            //return moment().diff();
        }
    }
};
</script>
