<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <router-link
                            :to="{ name: 'reserva' }"
                            class="btn btn-danger btn-sm"
                            style="width: 100px"
                        >
                            <i class="fa fa-backspace mr-1 fa-lg"></i>Volver
                        </router-link>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <!-- data de la caja -->
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <caja-data :caja="caja" />

                                        <a
                                            @click="editModal()"
                                            style="margin-left: 30px"
                                            class="btn btn-primary text-white col-5"
                                            >Cerrar caja</a
                                        >

                                        <a
                                            @click="createPago()"
                                            class="btn btn-primary btn-danger text-white col-5 ml-2"
                                            >Eliminar</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- cierre data de la reserva -->

                            <!-- data multiple -->
                            <div class="col-md-8">
                                <div class="card card-secondary">
                                    <!--  para cambiar de tablas -->
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link active text-white"
                                                    href="#settings"
                                                    data-toggle="tab"
                                                    >default</a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link text-white"
                                                    href="#activity"
                                                    data-toggle="tab"
                                                    >Pagos</a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link text-white"
                                                    href="#timeline"
                                                    data-toggle="tab"
                                                    >Consumos</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- cierre para cambiar de tablas -->
                                    <!-- multiples tablas -->
                                    <div class="card-body">
                                        <!-- tabla default -->
                                        <div class="tab-content">
                                            <div
                                                class="tab-pane active"
                                                id="settings"
                                            >
                                                default data
                                            </div>
                                            <!-- cierre tabla default -->
                                            <!--  tabla de pagos -->
                                            <div
                                                class="tab-pane"
                                                id="activity"
                                            ></div>
                                            <!-- cierre de tabla de pagos -->
                                            <!-- tabla de consumos -->
                                            <div
                                                class="tab-pane"
                                                id="timeline"
                                            ></div>
                                            <!-- cierre tabla de consumos -->
                                        </div>
                                    </div>
                                    <!-- cierre de multiples tablas -->
                                </div>
                            </div>
                            <!-- data multiple -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import cajaData from "./cajaData.vue";
export default {
    components: {
        cajaData
    },
    computed: {
        ...mapState("caja", ["caja"])
    },

    data() {
        return {};
    }
};
</script>
<style scoped></style>
