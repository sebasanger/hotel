<template>
    <div class="reservaComponent">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <button
                            class="btn-info float-right text-white"
                            @click="newModal"
                        >
                            Agregar reserva
                        </button>
                        <h5>Reservas</h5>
                    </div>

                    <GSTC
                        :config="config"
                        @state="onState"
                        @click="console.log(config)"
                    />
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <reserva-modal
            :form="form"
            :habitaciones="habitacionesDisponibles"
            :clientes="clientes"
            :preciosHabitaciones="preciosHabitaciones"
            :motivos="motivos"
            :editMode="editMode"
            :modosPagos="modosPagos"
            :caja="cajaActiva"
        />
        <ModalCliente :form="form" :facturas="facturas" :editMode="false" />
    </div>
</template>

<script>
import GSTC from "vue-gantt-schedule-timeline-calendar";
import CalendarScroll from "gantt-schedule-timeline-calendar/dist/CalendarScroll.plugin.js";
import { mapState, mapGetters } from "vuex";
import ReservaModal from "./reservaModal.vue";
import ModalCliente from "../Cliente/clienteModal.vue";

let router;
let selectionApi;
let subs = [];

export default {
    name: "reservas",
    components: {
        GSTC,
        ReservaModal,
        ModalCliente
    },
    data() {
        return {
            editMode: false,
            form: new Form({
                id: "",
                clientes_id: "",
                preciosHabitaciones_id: "",
                motivos_id: "",
                habitaciones_id: "",
                modosPagos_id: "",
                ingreso: "",
                egreso: "",
                pagado: "",
                huespedes: "",
                patenteAuto: "",
                destino: "",
                procedencia: ""
            }),
            config: {
                actions: {
                    "chart-timeline-items-row-item": [this.itemClickAction]
                },
                plugins: [
                    CalendarScroll({
                        speed: 0.05,
                        hideScroll: true
                    })
                ],

                height: 700,
                locale: {
                    name: "es",
                    weekdays: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miercoles",
                        "Jueves",
                        "Viernes",
                        "Sabado"
                    ],
                    months: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Ocutubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                },
                list: {
                    rows: {},
                    columns: {
                        data: {
                            numeroHabitacion: {
                                id: "numeroHabitacion",
                                data: "numeroHabitacion",
                                width: 60,
                                header: {
                                    content: "Numero"
                                }
                            },

                            piso: {
                                id: "piso",
                                data: "piso",
                                width: 50,
                                header: {
                                    content: "Piso"
                                }
                            },
                            single: {
                                id: "single",
                                data: "single",
                                width: 50,
                                header: {
                                    content: "Single"
                                }
                            },
                            doble: {
                                id: "doble",
                                data: "doble",
                                width: 100,
                                header: {
                                    content: "Matrimoñales"
                                }
                            }
                        }
                    }
                },
                chart: {
                    items: {
                        "1": {
                            id: "1",
                            rowId: "1",
                            label: "Item 1",
                            time: {
                                start: new Date().getTime(),
                                end: new Date().getTime() + 24 * 60 * 60 * 1000
                            }
                        },
                        "2": {
                            id: "2",
                            rowId: "2",
                            label: "Item 2",
                            time: {
                                start:
                                    new Date().getTime() +
                                    4 * 24 * 60 * 60 * 1000,
                                end:
                                    new Date().getTime() +
                                    5 * 24 * 60 * 60 * 1000
                            }
                        },
                        "3": {
                            id: "3",
                            rowId: "2",
                            label: "Item 3",
                            time: {
                                start:
                                    new Date().getTime() +
                                    6 * 24 * 60 * 60 * 1000,
                                end:
                                    new Date().getTime() +
                                    7 * 24 * 60 * 60 * 1000
                            }
                        },
                        "4": {
                            id: "4",
                            rowId: "3",
                            label: "Item 4",
                            time: {
                                start:
                                    new Date().getTime() +
                                    10 * 24 * 60 * 60 * 1000,
                                end:
                                    new Date().getTime() +
                                    12 * 24 * 60 * 60 * 1000
                            }
                        },
                        "5": {
                            id: "5",
                            rowId: "4",
                            label: "Item 5",
                            time: {
                                start:
                                    new Date().getTime() +
                                    12 * 24 * 60 * 60 * 1000,
                                end:
                                    new Date().getTime() +
                                    20 * 24 * 60 * 60 * 1000
                            }
                        }
                    }
                }
            }
        };
    },
    computed: {
        ...mapState(["reservas", "elementos"]),
        ...mapState("caja", ["cajaActiva"]),
        ...mapState("habitacion", ["habitaciones"]),
        ...mapState("carga", [
            "motivos",
            "clientes",
            "preciosHabitaciones",
            "modosPagos",
            "facturas"
        ]),
        ...mapGetters("habitacion", ["habitacionesDisponibles"])
    },
    watch: {
        elementos() {
            this.config.chart.items = this.elementos;
        },
        habitaciones() {
            this.config.list.rows = this.habitaciones;
        }
    },

    methods: {
        async cargar() {
            try {
                this.$store.dispatch("habitacion/fetchHabitaciones");
                this.$store.dispatch("fetchReservas");
            } catch (e) {
                console.error(e);
            }
        },
        newModal() {
            this.editMode = false;
            this.$store.dispatch("carga/fetchAllClientes");
            this.$store.dispatch("carga/fetchAllMotivos");
            this.$store.dispatch("carga/fetchAllPreciosHabitaciones");
            this.$store.dispatch("carga/fetchAllModosPagos");
            this.form.reset();
            $("#addNew").modal("show");
        },
        itemClickAction(element, data) {
            function onClick(event) {
                router.push({
                    name: "reservaShow",
                    params: { id: data.item.id }
                });
            }
            element.addEventListener("click", onClick);
            return {
                update(element, newData) {
                    data = newData; // data from parent scope updated
                },

                destroy(element, data) {
                    element.removeEventListener("click", onClick);
                }
            };
        },
        onState(state) {
            this.state = state;
        }
    },

    created() {
        router = this.$router;
    },

    mounted() {
        this.cargar();
        this.$Progress.finish();
    },
    beforeDestroy() {
        subs.forEach(unsub => unsub());
    }
};
</script>
