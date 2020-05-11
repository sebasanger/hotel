<template>
    <div>
        <section class="jumbotron text-center">
            <div class="container">
                <h1>Hotel vito</h1>
                <p class="lead text-muted">
                    SINGLE: $950 <br />
                    DOBLE: $1600 <br />
                    TRIPLE: $1900 <br />
                    CUÁDRUPLE: $2400 <br />
                    <small> Desayuno incluido </small>
                </p>
                <p>
                    <a href="#" class="btn btn-primary my-2"
                        >Realizar una reservacion</a
                    >
                    <a href="#" class="btn btn-secondary my-2"
                        >Mas informacion</a
                    >
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div
                        class="col-md-4"
                        v-for="habitacion in habitaciones"
                        :key="habitacion.id"
                    >
                        <div
                            class="card mb-4 shadow-sm"
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
                                            aria-label="Placeholder: Thumbnail"
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
                                            aria-label="Placeholder: Thumbnail"
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
                                            aria-label="Placeholder: Thumbnail"
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
                                            type="button"
                                            class="btn btn-sm btn-outline-secondary"
                                        >
                                            Ver
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-secondary"
                                        >
                                            Mas detalles
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    mounted() {
        this.$Progress.finish();
    },
    computed: {
        ...mapState("habitacion", ["habitaciones"]),

        getFoto() {
            return "img/habitaciones/" + this.habitacion.image_path;
        }
    }
};
</script>
