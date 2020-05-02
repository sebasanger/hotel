<template>
    <div>
        <NotificationContainer />
    </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
import NotificationContainer from "./ExtraComponents/NotificationContainer.vue";
export default {
    components: {
        NotificationContainer
    },
    mounted() {
        //  [App.vue specific] When App.vue is finish loading finish the progress bar
        this.$Progress.finish();
    },
    computed: {},
    created() {
        this.$store.dispatch("user/fetchUser");

        //  [App.vue specific] When App.vue is first loaded start the progress bar
        this.$Progress.start();
        //  hook the progress bar to start before we move router-view
        this.$router.beforeEach((to, from, next) => {
            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress;
                // parse meta tags
                this.$Progress.parseMeta(meta);
            }
            //  start the progress bar
            this.$Progress.start();
            //  continue to next page
            next();
        });
        //  hook the progress bar to finish after we've finished moving router-view
        this.$router.afterEach((to, from) => {
            //  finish the progress bar
        });
    },
    beforeCreate() {
        this.$store.dispatch("habitacion/fetchHabitaciones");
        this.$store.dispatch("fetchReservas");
        this.$store.dispatch("cliente/fetchClientes", 1);
        this.$store.dispatch("carga/fetchMotivos");
        this.$store.dispatch("carga/fetchPreciosHabitaciones");
        this.$store.dispatch("carga/fetchClientes");
        this.$store.dispatch("caja/fetchCaja");
    }
};
</script>

<style>
.fade-list-enter {
    opacity: 0.05;
}
.fade-list-enter-active {
    transition: all 0.7s ease-in;
}
table th {
    text-align: center;
    color: darkblue;
}
</style>
