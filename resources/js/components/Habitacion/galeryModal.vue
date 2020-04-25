<template>
    <div>
        <!-- Modal de galeria -->
        <div
            class="modal fade"
            id="galery"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="galery"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-xl" role="img">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="galery"
                            v-text="'Imagenes de la habitacion'"
                        ></h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div
                            id="carouselExampleIndicators"
                            class="carousel slide"
                            data-ride="carousel"
                        >
                            <ol class="carousel-indicators">
                                <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="0"
                                    class="active"
                                    v-if="habitacion.image_path"
                                ></li>
                                <li
                                    v-if="habitacion.image_path2"
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="1"
                                ></li>
                                <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="2"
                                    v-if="habitacion.image_path3"
                                ></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img
                                        :src="getFoto"
                                        class="d-block w-100"
                                        height="650"
                                    />
                                </div>
                                <div
                                    class="carousel-item"
                                    v-if="habitacion.image_path2"
                                >
                                    <img
                                        :src="getFoto2"
                                        class="d-block w-100"
                                        height="650"
                                    />
                                </div>
                                <div
                                    class="carousel-item"
                                    v-if="habitacion.image_path3"
                                >
                                    <img
                                        :src="getFoto3"
                                        class="d-block w-100"
                                        height="650"
                                    />
                                </div>
                            </div>
                            <a
                                class="carousel-control-prev"
                                href="#carouselExampleIndicators"
                                role="button"
                                data-slide="prev"
                            >
                                <span
                                    class="carousel-control-prev-icon"
                                    aria-hidden="true"
                                ></span>
                                <span class="sr-only black">Previous</span>
                            </a>
                            <a
                                class="carousel-control-next"
                                href="#carouselExampleIndicators"
                                role="button"
                                data-slide="next"
                            >
                                <span
                                    class="carousel-control-next-icon"
                                    aria-hidden="true"
                                ></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Salir
                            </button>
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
    computed: {
        ...mapState("habitacion", ["habitacion"]),

        getFoto() {
            return "img/habitaciones/" + this.habitacion.image_path;
        },
        getFoto2() {
            return "img/habitaciones/" + this.habitacion.image_path2;
        },
        getFoto3() {
            return "img/habitaciones/" + this.habitacion.image_path3;
        }
    }
};
</script>
