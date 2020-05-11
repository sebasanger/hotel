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
                            <!-- data de la reserva -->
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <reserva-data :reserva="reserva" />

                                        <a
                                            @click="editModal(reserva)"
                                            style="margin-left: 30px"
                                            class="btn btn-primary text-white col-5"
                                            >Editar reserva</a
                                        >

                                        <button
                                            :disabled="
                                                pagosReservas.length != 0 &&
                                                    consumosReserva.length != 0
                                            "
                                            @click="deleteReserva(reserva.id)"
                                            class="btn btn-primary btn-danger text-white col-5 ml-2"
                                        >
                                            Eliminar reserva
                                        </button>
                                        <a
                                            v-if="caja.cajaActiva == 1"
                                            style="margin-left: 30px"
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-success text-white col-5 mt-2"
                                            >Agregar pago</a
                                        >

                                        <a
                                            v-if="caja.cajaActiva == 1"
                                            @click="createConsumo(reserva)"
                                            class="btn btn-primary btn-success text-white col-5 mt-2 ml-2"
                                            >Agregar consumo</a
                                        >
                                        <a
                                            v-if="caja.cajaActiva == 0"
                                            style="margin-left: 30px"
                                            class="btn btn-primary btn-warning text-white col-5 mt-2"
                                            >Abrir caja</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- cierre data de la reserva -->

                            <!-- cliente -->
                            <div class="col-md-2">
                                <cliente-show
                                    :reserva="reserva"
                                    :facturas="facturas"
                                    :cliente="cliente"
                                />
                            </div>
                            <!-- cierre data del cliente -->

                            <!-- data multiple -->
                            <div class="col-md-6">
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
                                                v-if="pagosReservas.length >= 1"
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
                                                v-if="
                                                    consumosReserva.length >= 1
                                                "
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
                                                v-if="pagosReservas.length >= 1"
                                            >
                                                <pago-list
                                                    :pagos="pagosReservas"
                                                />
                                            </div>
                                            <!-- cierre de tabla de pagos -->
                                            <!-- tabla de consumos -->
                                            <div
                                                class="tab-pane"
                                                id="timeline"
                                                v-if="
                                                    consumosReserva.length >= 1
                                                "
                                            >
                                                <consumo-list
                                                    :consumos="consumosReserva"
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
            :caja="caja"
        />

        <consumo-modal
            :formConsumo="formConsumo"
            :reserva="reserva"
            :modosPagos="modosPagos"
            :caja="caja"
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
import ClienteShow from "./ClienteShow.vue";
import ReservaData from "./ReservaData.vue";

export default {
    components: {
        ReservaModal,
        PagoModal,
        PagoList,
        ClienteShow,
        ReservaData,
        ConsumoList,
        ConsumoModal
    },
    data() {
        return {
            editMode: "false",
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
                procedencia: ""
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
        ...mapState("caja", ["caja"])
    },
    methods: {
        cargar() {
            this.$store
                .dispatch("fetchReserva", this.$route.params.id)
                .then(res => {
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        editModal(reserva) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(reserva);
        },
        createPago(reserva) {
            this.formPago.reset();
            $("#addPago").modal("show");
        },
        createConsumo(reserva) {
            this.formConsumo.reset();
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
        }
    }
};
</script>
