<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- data de la caja -->
                        <div class="col-md-5">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <data-caja :caja="cajaShow" />
                                </div>
                            </div>
                        </div>
                        <!-- cierre data de la reserva -->

                        <!-- data multiple -->
                        <div
                            class="col-md-12"
                            v-if="
                                ingresosCaja.length != 0 ||
                                    egresosCaja.length != 0 ||
                                    pagosCajas.length != 0 ||
                                    consumosCaja.length != 0
                            "
                        >
                            <div class="card card-dark">
                                <!--  para cambiar de tablas -->
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li
                                            class="nav-item"
                                            v-if="ingresosCaja.length >= 1"
                                        >
                                            <a
                                                class="nav-link active text-white"
                                                href="#ingresos"
                                                data-toggle="tab"
                                                >Ingresos</a
                                            >
                                        </li>
                                        <li
                                            class="nav-item"
                                            v-if="egresosCaja.length >= 1"
                                        >
                                            <a
                                                :class="[
                                                    ingresosCaja.length == 0
                                                        ? 'active'
                                                        : ''
                                                ]"
                                                class="nav-link text-white"
                                                href="#egresos"
                                                data-toggle="tab"
                                                >Egresos</a
                                            >
                                        </li>
                                        <li
                                            class="nav-item"
                                            v-if="pagosCajas.length >= 1"
                                        >
                                            <a
                                                :class="[
                                                    ingresosCaja.length == 0 &&
                                                    egresosCaja.length == 0
                                                        ? 'active'
                                                        : ''
                                                ]"
                                                class="nav-link text-white"
                                                href="#pagos"
                                                data-toggle="tab"
                                                >Pagos</a
                                            >
                                        </li>
                                        <li
                                            class="nav-item"
                                            v-if="consumosCaja.length >= 1"
                                        >
                                            <a
                                                :class="[
                                                    ingresosCaja.length == 0 &&
                                                    egresosCaja.length == 0 &&
                                                    pagosCajas.length == 0
                                                        ? 'active'
                                                        : ''
                                                ]"
                                                class="nav-link text-white"
                                                href="#consumos"
                                                data-toggle="tab"
                                                >Consumos</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <!-- cierre para cambiar de tablas -->
                                <!-- multiples tablas -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- tabla ingresos -->
                                        <div
                                            class="tab-pane active"
                                            id="ingresos"
                                            v-if="ingresosCaja.length >= 1"
                                        >
                                            <movimiento-list
                                                :movimientos="ingresosCaja"
                                            />
                                        </div>
                                        <!-- cierre tabla de ingresos -->
                                        <!-- tabla egresos -->
                                        <div
                                            class="tab-pane"
                                            id="egresos"
                                            :class="[
                                                ingresosCaja.length == 0
                                                    ? 'active'
                                                    : ''
                                            ]"
                                            v-if="egresosCaja.length >= 1"
                                        >
                                            <movimiento-list
                                                :movimientos="egresosCaja"
                                            />
                                        </div>
                                        <!-- cierre tabla de egresos -->
                                        <!--  tabla de pagos -->
                                        <div
                                            :class="[
                                                ingresosCaja.length == 0 &&
                                                egresosCaja.length == 0
                                                    ? 'active'
                                                    : ''
                                            ]"
                                            class="tab-pane"
                                            id="pagos"
                                            v-if="pagosCajas.length >= 1"
                                        >
                                            <pago-list :pagos="pagosCajas" />
                                        </div>
                                        <!-- cierre de tabla de pagos -->

                                        <!-- tabla de consumos -->
                                        <div
                                            :class="[
                                                ingresosCaja.length == 0 &&
                                                egresosCaja.length == 0 &&
                                                pagosCajas.length == 0
                                                    ? 'active'
                                                    : ''
                                            ]"
                                            class="tab-pane"
                                            id="consumos"
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
    </div>
</template>

<script>
import { mapState } from "vuex";
import dataCaja from "./CajaData.vue";
import PagoList from "./pagoListCaja.vue";
import ConsumoList from "./ConsumoListCaja.vue";
import MovimientoList from "../Movimiento/MovimientoList.vue";
export default {
    components: {
        dataCaja,
        ConsumoList,
        PagoList,
        MovimientoList
    },

    computed: {
        ...mapState("caja", ["cajaShow"]),
        ...mapState("movimiento", ["ingresosCaja", "egresosCaja"]),
        ...mapState("carga", ["modosPagos"]),
        ...mapState("pago", ["pagosCajas"]),
        ...mapState("consumo", ["consumosCaja"])
    },
    created() {
        this.cargar();
    },
    methods: {
        async cargar() {
            try {
                this.$store
                    .dispatch("caja/fetchCajaShow", this.$route.params.id)
                    .then(res => {
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            } catch (e) {
                console.error(e);
            }
        },
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
<style scoped>
.card {
    color: white;
}
</style>
