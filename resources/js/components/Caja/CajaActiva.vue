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
                                    <caja-data :caja="caja" />
                                    <div class="row mb-2">
                                        <button
                                            @click="CreateEgreso()"
                                            style="margin-left: 30px"
                                            class="btn btn-primary text-white col-5"
                                        >
                                            Agregar egreso
                                        </button>

                                        <button
                                            @click="CreateIngreso()"
                                            class="btn btn-primary text-white ml-2 col-5"
                                        >
                                            Agregar ingreso
                                        </button>
                                    </div>
                                    <div class="row">
                                        <button
                                            @click="cerrarCaja()"
                                            style="margin-left: 30px"
                                            class="btn btn-success text-white col-5"
                                        >
                                            Cerrar caja
                                        </button>

                                        <button
                                            :disabled="
                                                pagosCajas.length != 0 ||
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
            <modal-cerrar-caja
                :formCerrarCaja="formCerrarCaja"
                :cajaActiva="caja"
            />
            <movimiento-modal
                :formMovimiento="formMovimiento"
                :ingreso="ingreso"
                :modosPagos="modosPagos"
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
import MovimientoModal from "../Movimiento/MovimeintoModal.vue";
import MovimientoList from "../Movimiento/MovimientoList.vue";
export default {
    components: {
        cajaData,
        ConsumoList,
        PagoList,
        ModalCerrarCaja,
        MovimientoModal,
        MovimientoList
    },
    data() {
        return {
            loaded: false,
            ingreso: true,
            formCerrarCaja: new Form({
                montoCierre: 0
            }),
            formMovimiento: new Form({
                monto: 0,
                tipo: "",
                modosPagos_id: "",
                cajas_id: "",
                descripcion: ""
            })
        };
    },
    mounted() {
        this.cargar();
    },
    computed: {
        ...mapState("caja", ["caja"]),
        ...mapState("movimiento", ["ingresosCaja", "egresosCaja"]),
        ...mapState("carga", ["modosPagos"]),
        ...mapState("pago", ["pagosCajas"]),
        ...mapState("consumo", ["consumosCaja"])
    },
    methods: {
        async cargar() {
            try {
                this.$store;
                this.$store
                    .dispatch("caja/fetchCajaActiva")
                    .then(res => {
                        this.loaded = true;
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
        CreateIngreso() {
            this.ingreso = true;
            this.formMovimiento.reset();
            $("#addMovimiento").modal("show");
        },
        CreateEgreso() {
            this.ingreso = false;
            this.formMovimiento.reset();
            $("#addMovimiento").modal("show");
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
