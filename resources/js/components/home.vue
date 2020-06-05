<template>
    <div>
        <div class="container text-center">
            <h1>Hotel Vito</h1>
            <p class="lead text-muted">
                SINGLE: $950
            </p>
            <p class="lead text-muted">
                DOBLE: $1600
            </p>
            <p class="lead text-muted">
                TRIPLE: $1900
            </p>
            <p class="lead text-muted">
                CUÁDRUPLE: $2400
            </p>
            <p class="lead text-muted">
                <small> Desayuno incluido </small>
            </p>
        </div>

        <div class="container">
            <div class="row">
                <div
                    class="col-md-4"
                    v-for="habitacion in habitacionesReales"
                    :key="habitacion.id"
                >
                    <div
                        class="card text-white mb-4 shadow-sm"
                        v-if="habitacion.image_path"
                    >
                        <div
                            id="carouselExampleSlidesOnly"
                            class="carousel slide"
                            data-ride="carousel"
                        >
                            <div class="carousel-inner">
                                <div
                                    data-interval="10000"
                                    class="carousel-item active"
                                    v-if="habitacion.image_path"
                                >
                                    <img
                                        class="bd-placeholder-img card-img-top"
                                        width="100%"
                                        height="225"
                                        preserveAspectRatio="xMidYMid slice"
                                        focusable="false"
                                        :src="
                                            'img/habitaciones/' +
                                                habitacion.image_path
                                        "
                                    />
                                </div>
                                <div
                                    data-interval="10000"
                                    class="carousel-item"
                                    v-if="habitacion.image_path2"
                                >
                                    <img
                                        class="bd-placeholder-img card-img-top"
                                        width="100%"
                                        height="225"
                                        preserveAspectRatio="xMidYMid slice"
                                        focusable="false"
                                        :src="
                                            'img/habitaciones/' +
                                                habitacion.image_path
                                        "
                                    />
                                </div>
                                <div
                                    data-interval="10000"
                                    class="carousel-item"
                                    v-if="habitacion.image_path3"
                                >
                                    <img
                                        class="bd-placeholder-img card-img-top"
                                        width="100%"
                                        height="225"
                                        preserveAspectRatio="xMidYMid slice"
                                        focusable="false"
                                        :src="
                                            'img/habitaciones/' +
                                                habitacion.image_path
                                        "
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="card-text">
                                Habitacion numero:
                                {{ habitacion.numeroHabitacion }}
                            </p>
                            <p class="card-text">
                                Capacidad:
                                {{ habitacion.capacidad | capacidad }}
                            </p>
                            <p class="card-text">
                                {{ habitacion.piso | piso }}
                            </p>
                            <p class="card-text">
                                <i
                                    v-for="cs in habitacion.single"
                                    :key="cs.id"
                                    class="fa fa-bed red ml-1"
                                ></i>
                                <i
                                    v-for="cd in habitacion.doble"
                                    :key="cd"
                                    class="fa fa-bed blue ml-1"
                                ></i>
                            </p>

                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <div class="btn-group">
                                    <button
                                        v-if="
                                            habitacion.image_path ||
                                                habitacion.image_path2 ||
                                                habitacion.image_path3
                                        "
                                        @click="galery(habitacion.id)"
                                        class="btn btn-sm btn-outline-secondary btn-danger text-white"
                                    >
                                        Ver imagenes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <galeryModal />
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import galeryModal from "./Habitacion/galeryModal.vue";

export default {
    components: {
        galeryModal
    },
    mounted() {
        this.$store.dispatch("habitacion/fetchHabitaciones");
        this.$Progress.finish();
    },
    computed: {
        ...mapGetters("habitacion", ["habitacionesReales"]),

        getFoto() {
            return "img/habitaciones/" + this.habitacion.image_path;
        }
    },
    methods: {
        galery(id) {
            console.log("hola");
            this.$store
                .dispatch("habitacion/fetchHabitacion", id)
                .then(() => {
                    $("#galery").modal("show");
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        }
    }
};
</script>
<style scoped>
h1 {
    font-size: 80px;
    font-weight: bold;
}
.card {
    padding: 1px;
}
</style>
