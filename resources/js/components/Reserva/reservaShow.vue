<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <router-link
                            :to="{ name: 'reserva' }"
                            class="btn btn-danger btn-sm"
                        >
                            Atras
                        </router-link>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center"></div>
                                        <h3
                                            class="profile-username text-center"
                                        >
                                            Datos de la reserva
                                        </h3>

                                        <ul
                                            class="list-group list-group-unbordered mb-3"
                                        >
                                            <li class="list-group-item">
                                                <b>Numero de la habitacion:</b>
                                                <a class="float-right">
                                                    {{
                                                        reserva.numeroHabitacion
                                                    }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Precio por dia:</b>
                                                <a class="float-right">{{
                                                    reserva.precio
                                                }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Total a pagar:</b>
                                                <a class="float-right">
                                                    {{ reserva.totalPagar }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Total pagado:</b>
                                                <a class="float-right">
                                                    {{ reserva.pagado }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Falta pagar:</b>
                                                <a class="float-right">
                                                    {{ faltante }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Ingreso:</b>
                                                <a class="float-right">
                                                    {{
                                                        reserva.ingreso
                                                            | formatDate
                                                    }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Egreso:</b>
                                                <a class="float-right">
                                                    {{
                                                        reserva.egreso
                                                            | formatDate
                                                    }}</a
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <b>Dias totales:</b>
                                                <a class="float-right">
                                                    {{ betWeen }}</a
                                                >
                                            </li>
                                        </ul>

                                        <a
                                            @click="editModal(reserva)"
                                            class="btn btn-primary btn-block text-white"
                                            >Editar reserva</a
                                        >
                                        <a
                                            v-if="caja.cajaActiva == 1"
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-block btn-success text-white"
                                            >Agregar pago</a
                                        >
                                        <a
                                            v-if="caja.cajaActiva == 1"
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-block btn-success text-white"
                                            >Agregar consumo</a
                                        >
                                        <a
                                            v-else
                                            class="btn btn-primary btn-block btn-warning text-white"
                                            >Abrir caja</a
                                        >

                                        <a
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-block btn-danger text-white"
                                            >Eliminar reserva</a
                                        >
                                    </div>

                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Datos del cliente
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <strong
                                            ><i class="fas fa-book mr-1"></i>
                                            Nombre</strong
                                        >
                                        <p class="text-muted">
                                            {{
                                                (reserva.nombre +
                                                    " " +
                                                    reserva.apellido)
                                                    | capitalize
                                            }}
                                        </p>

                                        <div v-if="reserva.dni">
                                            <hr />
                                            <strong
                                                ><i
                                                    class="fas fa-passport mr-1"
                                                ></i>
                                                DNI</strong
                                            >

                                            <p class="text-muted">
                                                {{ reserva.dni }}
                                            </p>
                                        </div>

                                        <div v-if="reserva.tipoFactura">
                                            <hr />
                                            <strong
                                                ><i
                                                    class="fas fa-book mr-1"
                                                ></i>
                                                Tipo de factura</strong
                                            >

                                            <p class="text-muted">
                                                {{ reserva.tipoFactura }}
                                            </p>
                                        </div>

                                        <div v-if="reserva.procedencia">
                                            <hr />
                                            <strong
                                                ><i
                                                    class="fas fa-map-marker-alt mr-1"
                                                ></i>
                                                Procedencia del cliente</strong
                                            >

                                            <p class="text-muted">
                                                {{
                                                    reserva.procedencia
                                                        | capitalize
                                                }}
                                            </p>
                                        </div>

                                        <div v-if="reserva.destino">
                                            <hr />
                                            <strong
                                                ><i
                                                    class="fas fa-map-marker-alt mr-1"
                                                ></i>
                                                Destino del huesped</strong
                                            >

                                            <p class="text-muted">
                                                {{
                                                    reserva.destino | capitalize
                                                }}
                                            </p>
                                        </div>

                                        <div v-if="reserva.celular">
                                            <hr />
                                            <strong
                                                ><i
                                                    class="fas fa-phone mr-1"
                                                ></i>
                                                Celular</strong
                                            >

                                            <p class="text-muted">
                                                {{ reserva.celular }}
                                            </p>
                                        </div>

                                        <div v-if="reserva.patenteAuto">
                                            <hr />
                                            <strong
                                                ><i class="fas fa-car mr-1"></i>
                                                Patente del auto</strong
                                            >

                                            <p class="text-muted">
                                                {{ reserva.patenteAuto }}
                                            </p>
                                        </div>
                                        <a
                                            @click="createPago(reserva)"
                                            class="btn btn-primary btn-block btn-info text-white"
                                            >Editar cliente</a
                                        >
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link active"
                                                    href="#settings"
                                                    data-toggle="tab"
                                                    >default</a
                                                >
                                            </li>
                                            <li
                                                class="nav-item"
                                                v-if="pagos.length >= 1"
                                            >
                                                <a
                                                    class="nav-link"
                                                    href="#activity"
                                                    data-toggle="tab"
                                                    >Consumos</a
                                                >
                                            </li>
                                            <li
                                                class="nav-item"
                                                v-if="pagos.length >= 1"
                                            >
                                                <a
                                                    class="nav-link"
                                                    href="#timeline"
                                                    data-toggle="tab"
                                                    >Pagos</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div
                                                class="tab-pane active"
                                                id="settings"
                                            >
                                                default data
                                            </div>
                                            <div
                                                class="tab-pane"
                                                id="activity"
                                                v-if="pagos.length >= 1"
                                            >
                                                <pago-list :pagos="pagos" />
                                            </div>
                                            <div
                                                class="tab-pane"
                                                id="timeline"
                                                v-if="pagos.length >= 1"
                                            >
                                                <pago-list :pagos="pagos" />
                                            </div>

                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
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
    </div>
</template>

<script>
import { mapState } from "vuex";
import moment from "moment";
import ReservaModal from "./reservaModal.vue";
import PagoModal from "../Pago/PagoModal.vue";
import PagoList from "../Pago/pagoList.vue";

export default {
    components: {
        ReservaModal,
        PagoModal,
        PagoList
    },
    props: ["id"],
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
            })
        };
    },
    created() {
        this.$store
            .dispatch("fetchReserva", this.id)
            .then(() => {
                this.$Progress.finish();
            })
            .catch(() => {
                this.$Progress.fail();
            });
        this.$store.dispatch("pago/fetchPagosByReserva", this.id);
    },
    computed: {
        ...mapState("habitacion", ["habitaciones"]),
        ...mapState(["reserva"]),
        ...mapState("pago", ["pagos"]),
        ...mapState("carga", [
            "motivos",
            "clientes",
            "preciosHabitaciones",
            "modosPagos"
        ]),
        ...mapState("caja", ["caja"]),
        betWeen() {
            var a = moment(this.reserva.egreso);
            var b = moment(this.reserva.ingreso);
            return a.diff(b, "days");
            //return moment().diff();
        },
        faltante() {
            return this.reserva.totalPagar - this.reserva.pagado;
        }
    },
    methods: {
        editModal(reserva) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(reserva);
        },
        createPago(reserva) {
            this.formPago.reset();
            $("#addPago").modal("show");
        }
    }
};
</script>
