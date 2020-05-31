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
    created() {
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
    async mounted() {
        try {
            this.$store.dispatch("user/fetchUser");
            this.$store.dispatch("caja/getCajaActiva");
            /*
            this.$store.dispatch("carga/fetchAllClientes");
            this.$store.dispatch("producto/fetchAllProductos");
            this.$store.dispatch("carga/fetchAllMotivos");
            this.$store.dispatch("carga/fetchAllPreciosHabitaciones");
            this.$store.dispatch("carga/fetchAllModosPagos");
            this.$store.dispatch("carga/fetchAllFacturas");
            */
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style>
.modal .modal-content {
    background: #343a40;
    color: white;
    font-size: 15px;
}
.modal .modal-header {
    text-align: center;
    align-content: center;
}

.modal h5 {
    font-size: 28px;
    color: white;
    font-family: serif;
    font-weight: bold;
}

.fade-list-enter {
    opacity: 0.05;
}
.fade-list-enter-active {
    transition: all 0.7s ease-in;
}
table th {
    text-align: center;
}

.cambiarColor {
    animation: colorchange 50s infinite;
}
@keyframes colorchange {
    0% {
        background: rgba(133, 240, 240, 0.1);
    }
    25% {
        background: rgba(136, 123, 245, 0.1);
    }
    50% {
        background: rgba(236, 108, 219, 0.1);
    }
    75% {
        background: rgba(236, 83, 83, 0.1);
    }
    100% {
        background: rgba(230, 191, 84, 0.1);
    }
}

.Chart {
    background: #212733;
    border-radius: 15px;
    box-shadow: 0px 2px 15px rgba(25, 25, 25, 0.27);
    margin-bottom: 25px;
    font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
}
.Chart h2 {
    margin-top: 0;
    padding: 15px 0;
    color: rgba(255, 0, 0, 0.5);
    border-bottom: 1px solid #323d54;
}

.select-chart {
    float: left;
    padding-top: 15px;
    padding-left: 20px;
}
.select-chart label {
    color: red;
    font-size: 20px;
}

.card {
    margin-top: 4px;
    background: #343a40;
    border-radius: 10px;
    box-shadow: 3px 3px 15px rgb(41, 41, 41);
    margin-bottom: 25px;
}

.card h5 {
    font-size: 30px;
    color: white;
    font-family: serif;
    font-weight: bold;
    text-align: center;
}

.tituloHotel {
    color: white;
    font-family: serif;
    font-weight: bold;
    text-align: center;
}

.card .table {
    background: #ffffff;
    text-align: center;
}

.card .card-header .btn-info {
    margin-top: 5px;
}

.card thead tr th {
    font-size: 17px;
    font-weight: bold;
}

.card tr td {
    padding-top: 15px;
    padding-bottom: 15px;
}

.card tr td .btn {
    padding-top: 0px;
    padding-left: 10px;
    padding-right: 10px;
}

.minh-100 {
    height: 100vh;
}
</style>
