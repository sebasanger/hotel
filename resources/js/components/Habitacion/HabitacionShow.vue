<template>
    <div>
        <p>numero habitacion: {{ habitacion.numeroHabitacion }}</p>
        <p>Capacidad: {{ habitacion.capacidad }}</p>
        <p>camas singles: {{ habitacion.singles }}</p>
        <p>Camas matrimoñales: {{ habitacion.dobles }}</p>
        <p>estado: {{ habitacion.numeroHabitacion }}</p>

        <router-link :to="{ name: 'habitaciones' }">atras</router-link>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    props: ["id"],
    created() {
        this.$store
            .dispatch("habitacion/fetchHabitacion", this.id)
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
        ...mapState("habitacion", ["habitacion"])
    }
};
</script>
