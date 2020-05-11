<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <router-link
                            :to="{ name: 'caja' }"
                            class="btn btn-danger btn-sm"
                            style="width: 100px"
                        >
                            <i class="fa fa-backspace mr-1 fa-lg"></i>Volver
                        </router-link>
                    </div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <!-- data de la caja -->
                            <div class="col-md-5">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <caja-data :caja="caja" />

                                        <a
                                            @click="cerrarCaja()"
                                            style="margin-left: 30px"
                                            class="btn btn-primary text-white col-5"
                                            >Cerrar caja</a
                                        >

                                        <button
                                            :disabled="
                                                pagosCajas.length != 0 &&
                                                    consumosCaja.length != 0
                                            "
                                            @click="deleteCaja(caja.id)"
                                            class="btn btn-primary btn-danger text-white col-5 ml-2"
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- cierre data de la reserva -->

                            <!-- data multiple -->
                            <div class="col-md-12">
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
                                            <li
                                                class="nav-item"
                                                v-if="pagosCajas.length >= 1"
                                            >
                                                <a
                                                    class="nav-link text-white"
                                                    href="#activity"
                                                    data-toggle="tab"
                                                    >Pagos</a
                                                >
                                            </li>
                                            <li
                                                class="nav-item"
                                                v-if="consumosCaja.length >= 1"
                                            >
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
                                                v-if="pagosCajas.length >= 1"
                                            >
                                                <pago-list
                                                    :pagos="pagosCajas"
                                                />
                                            </div>
                                            <!-- cierre de tabla de pagos -->

                                            <!-- tabla de consumos -->
                                            <div
                                                class="tab-pane"
                                                id="timeline"
                                                v-if="consumosCaja.length >= 1"
                                            >
                                                <consumo-list
                                                    :consumos="consumosCaja"
                                                />
                                            </div>
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
            <modal-cerrar-caja
                :formCerrarCaja="formCerrarCaja"
                :cajaActiva="caja"
            />
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import cajaData from "./cajaData.vue";
import PagoList from "./pagoListCaja.vue";
import ConsumoList from "./ConsumoListCaja.vue";
import ModalCerrarCaja from "./CerarCajaModal.vue";
export default {
    components: {
        cajaData,
        ConsumoList,
        PagoList,
        ModalCerrarCaja
    },
    data() {
        return {
            formCerrarCaja: new Form({
                montoCierre: 0
            })
        };
    },
    computed: {
        ...mapState("caja", ["caja"]),
        ...mapState("pago", ["pagosCajas"]),
        ...mapState("consumo", ["consumosCaja"])
    },
    created() {
        this.$store
            .dispatch("caja/fetchCajaActiva")
            .then(res => {
                this.$Progress.finish();
            })
            .catch(() => {
                this.$Progress.fail();
            });
    },
    methods: {
        cerrarCaja() {
            this.formCerrarCaja.reset();
            $("#cerrarCaja").modal("show");
        },
        deleteCaja(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar esta caja?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios.delete("caja/" + id).then(() => {
                        this.$router.push({ name: "home" });
                        this.$store.dispatch("caja/fetchCajaActiva");
                        Swal.fire(
                            "Eliminado!",
                            "La caja se elimino correctamente.",
                            "success"
                        );
                    });
                }
            });
        }
    }
};
</script>
<style scoped></style>
