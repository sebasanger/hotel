<template>
    <div id="app">
        <GSTC :config="config" @state="onState" @click="console.log(config)" />

        <!-- Modal -->
        <div
            class="modal fade"
            id="modalInfo"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalInfo"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="modalInfo"
                            v-text="'Informacion'"
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
                        <div id="miId"></div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import GSTC from "vue-gantt-schedule-timeline-calendar";
import CalendarScroll from "gantt-schedule-timeline-calendar/dist/CalendarScroll.plugin.js";

import { mapState, mapGetters } from "vuex";

let router;
let selectionApi;
let subs = [];

export default {
    name: "app",
    components: {
        GSTC
    },
    data() {
        return {
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

                height: 800,
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
                            id: {
                                id: "id",
                                data: "id",
                                width: 0,
                                header: {
                                    content: "ID"
                                }
                            },

                            numeroHabitacion: {
                                id: "numeroHabitacion",
                                data: "numeroHabitacion",
                                width: 100,
                                header: {
                                    content: "Habitacion"
                                }
                            },
                            capacidad: {
                                id: "capacidad",
                                data: "capacidad",
                                width: 90,
                                header: {
                                    content: "Capacidad"
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
                                    14 * 24 * 60 * 60 * 1000
                            }
                        }
                    }
                }
            }
        };
    },
    computed: {
        ...mapState(["reservas"]),
        loadItems() {
            this.reservas.forEach(element => {
                this.config.chart.items[element.id] = {
                    id: element.id.toString(),
                    rowId: element.habitaciones_id.toString(),
                    label:
                        element.nombre +
                        " " +
                        element.apellido +
                        " " +
                        element.numeroHabitacion,
                    pagado: element.pagado,
                    huespedes: element.huespedes,
                    patenteAuto: element.patenteAuto,
                    nombre: element.nombre,
                    apellido: element.apellido,
                    numeroHabitacion: element.numeroHabitacion,
                    precio: element.precio,
                    totalPagar: element.totalPagar,
                    created_at: element.created_at,
                    style: {
                        background: element.color
                    },
                    time: {
                        start: new Date(element.ingreso).getTime(),
                        end: new Date(element.egreso).getTime()
                    }
                };
            });
        }
    },

    methods: {
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
        },
        loadHabitaciones() {
            axios
                .get("habitacion")
                .then(res => {
                    this.config.list.rows = res.data.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    router.push({
                        name: "500"
                    });
                });
        }
    },

    created() {
        router = this.$router;
    },
    mounted() {
        this.loadItems;
        this.loadHabitaciones();
    },

    beforeDestroy() {
        subs.forEach(unsub => unsub());
    }
};
</script>
