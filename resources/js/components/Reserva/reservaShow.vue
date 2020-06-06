<template>
    <div>
        <div class="row">
            <div class="col-md-12" v-show="loaded">
                <div class="container-fluid">
                    <div class="row">
                        <!-- data de la reserva -->
                        <div class="col-md-3">
                            <div
                                class="card reserva-data card-primary card-outline"
                            >
                                <div class="card-body box-profile">
                                    <reserva-data :reserva="reserva" />

                                    <div v-if="!reserva.checkout">
                                        <button
                                            @click="editModal(reserva)"
                                            class="btn btn-primary btn-block btn-info text-white"
                                        >
                                            Editar reserva
                                        </button>

                                        <button
                                            :disabled="
                                                pagosReservas.length != 0 ||
                                                    consumosReserva.length !=
                                                        0 ||
                                                    reserva.checkin != null
                                            "
                                            @click="deleteReserva(reserva.id)"
                                            class="btn btn-primary btn-block btn-danger text-white"
                                        >
                                            Eliminar reserva
                                        </button>

                                        <button
                                            :disabled="
                                                cajaActiva.cajaActiva != 1
                                            "
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-block btn-success text-white"
                                        >
                                            Nuevo pago
                                        </button>

                                        <button
                                            :disabled="
                                                cajaActiva.cajaActiva != 1
                                            "
                                            @click="createConsumo(reserva)"
                                            class="btn btn-primary btn-block btn-success text-white"
                                        >
                                            Nuevo consumo
                                        </button>
                                        <button
                                            v-if="!reserva.checkin"
                                            @click="createCheckin(reserva.id)"
                                            class="btn btn-primary btn-block btn-warning text-dark"
                                        >
                                            Realizar checkin
                                        </button>

                                        <button
                                            :disabled="
                                                reserva.pagado <
                                                    reserva.totalPagar
                                            "
                                            v-if="
                                                reserva.checkin &&
                                                    !reserva.checkout
                                            "
                                            @click="createCheckout(reserva.id)"
                                            class="btn btn-primary btn-block btn-warning text-dark"
                                        >
                                            Realizar checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cierre data de la reserva -->

                        <!-- cliente -->
                        <div class="col-md-2">
                            <cliente-details
                                :reserva="reserva"
                                :facturas="facturas"
                                :cliente="cliente"
                            />
                        </div>
                        <!-- cierre data del cliente -->

                        <!-- data multiple -->
                        <div
                            class="col-md-7"
                            v-show="
                                pagosReservas.length >= 1 ||
                                    consumosReserva.length >= 1
                            "
                        >
                            <div class="card card-blue">
                                <!--  para cambiar de tablas -->
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li
                                            class="nav-item"
                                            v-if="pagosReservas.length >= 1"
                                        >
                                            <a
                                                class="nav-link active text-white"
                                                href="#pagos"
                                                data-toggle="tab"
                                                >Pagos</a
                                            >
                                        </li>
                                        <li
                                            class="nav-item "
                                            v-if="consumosReserva.length >= 1"
                                        >
                                            <a
                                                class="nav-link text-white"
                                                :class="[
                                                    pagosReservas.length == 0
                                                        ? 'active'
                                                        : ''
                                                ]"
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
                                    <!-- tabla default -->
                                    <div class="tab-content">
                                        <!-- cierre tabla default -->
                                        <!--  tabla de pagos -->
                                        <div
                                            class="tab-pane active"
                                            id="pagos"
                                            v-if="pagosReservas.length >= 1"
                                        >
                                            <pago-list
                                                :pagos="pagosReservas"
                                                :estado="reserva.estado"
                                            />
                                        </div>
                                        <!-- cierre de tabla de pagos -->
                                        <!-- tabla de consumos -->
                                        <div
                                            :class="[
                                                pagosReservas.length == 0
                                                    ? 'active'
                                                    : ''
                                            ]"
                                            class="tab-pane"
                                            id="consumos"
                                            v-if="consumosReserva.length >= 1"
                                        >
                                            <consumo-list
                                                :consumos="consumosReserva"
                                                :estado="reserva.estado"
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

        <reserva-modal
            v-if="reserva != null"
            :form="form"
            :habitaciones="habitaciones"
            :clientes="clientes"
            :preciosHabitaciones="preciosHabitaciones"
            :motivos="motivos"
            :editMode="editMode"
        />

        <pago-modal
            :formPago="formPago"
            :reserva="reserva"
            :modosPagos="modosPagos"
            :caja="cajaActiva"
        />

        <consumo-modal
            :formConsumo="formConsumo"
            :reserva="reserva"
            :modosPagos="modosPagos"
            :caja="cajaActiva"
            :productos="productos"
        />
    </div>
</template>

<script>
import { mapState } from "vuex";

import ReservaModal from "./reservaModal.vue";
import PagoModal from "../Pago/PagoModal.vue";
import ConsumoModal from "../Consumo/ConsumoModal.vue";
import PagoList from "../Pago/pagoList.vue";
import ConsumoList from "../Consumo/ConsumoList.vue";
import ClienteDetails from "./ClienteDetails.vue";
import ReservaData from "./ReservaData.vue";

export default {
    components: {
        ReservaModal,
        PagoModal,
        PagoList,
        ClienteDetails,
        ReservaData,
        ConsumoList,
        ConsumoModal
    },
    data() {
        return {
            editMode: "false",
            loaded: false,
            form: new Form({
                id: "",
                clientes_id: "",
                preciosHabitaciones_id: "",
                motivos_id: "",
                habitaciones_id: "",
                ingreso: "",
                egreso: "",
                pagado: "",
                huespedes: "",
                patenteAuto: "",
                destino: "",
                procedencia: "",
                checkin: ""
            }),
            formPago: new Form({
                id: "",
                reservas_id: "",
                modosPagos_id: "",
                monto: 0,
                cajas_id: ""
            }),
            formConsumo: new Form({
                id: "",
                reservas_id: "",
                modosPagos_id: "",
                productos_id: "",
                cantidad: 1,
                cajas_id: "",
                pagado: 0
            })
        };
    },
    created() {
        this.cargar();
    },
    computed: {
        ...mapState("habitacion", ["habitaciones"]),
        ...mapState("cliente", ["cliente"]),
        ...mapState(["reserva"]),
        ...mapState("pago", ["pagosReservas"]),
        ...mapState("consumo", ["consumosReserva"]),
        ...mapState("producto", ["productos"]),
        ...mapState("carga", [
            "motivos",
            "clientes",
            "preciosHabitaciones",
            "modosPagos",
            "facturas"
        ]),
        ...mapState("caja", ["cajaActiva"])
    },

    methods: {
        async cargar() {
            try {
                this.$store
                    .dispatch("fetchReserva", this.$route.params.id)
                    .then(res => {
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
                this.loaded = true;
            } catch (e) {
                this.$router.push({ name: "reserva" });
            }
        },
        editModal(reserva) {
            this.editMode = true;
            this.$store.dispatch("carga/fetchAllClientes");
            this.$store.dispatch("carga/fetchAllMotivos");
            this.$store.dispatch("carga/fetchAllPreciosHabitaciones");
            this.$store.dispatch("carga/fetchAllModosPagos");
            this.$store.dispatch("habitacion/fetchHabitaciones");
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(reserva);
        },
        createPago(reserva) {
            this.formPago.reset();
            this.$store.dispatch("carga/fetchAllModosPagos");
            $("#addPago").modal("show");
        },
        createConsumo(reserva) {
            this.formConsumo.reset();
            this.$store.dispatch("producto/fetchAllProductos");
            this.$store.dispatch("carga/fetchAllModosPagos");
            $("#addConsumo").modal("show");
        },
        deleteReserva(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar esta reserva?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios.delete("/reserva/" + id).then(() => {
                        this.$router.push({ name: "reserva" });
                        this.$store.dispatch("fetchReservas");
                        Swal.fire(
                            "Eliminado!",
                            "La reserva se elimino correctamente.",
                            "success"
                        );
                    });
                }
            });
        },
        createCheckin(id) {
            Swal.fire({
                title: "¿Realizar checkin?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si!"
            }).then(result => {
                if (result.value) {
                    axios.get("/checkinReserva/" + id).then(res => {
                        this.$store.dispatch("fetchReserva", res.data.id);
                        Swal.fire(
                            "Listo!",
                            "Se realizo el checkin correctamente.",
                            "success"
                        );
                    });
                }
            });
        },
        createCheckout(id) {
            Swal.fire({
                title: "¿Realizar checkout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si!"
            }).then(result => {
                if (result.value) {
                    axios.get("/checkoutReserva/" + id).then(res => {
                        this.$store.dispatch("fetchReserva", res.data.id);
                        Swal.fire(
                            "Listo!",
                            "Se finalizo al reserva correctamente",
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
