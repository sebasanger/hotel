<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <GSTC
                            :config="config"
                            @state="onState"
                            @click="console.log(config)"
                        />
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button
                            class="btn-success float-right"
                            @click="newModal"
                        >
                            Agregar reserva
                        </button>
                    </div>
                </div>
                <!-- /.card -->
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
    name: "reservas",
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
                                    14 * 24 * 60 * 60 * 1000
                            }
                        }
                    }
                }
            }
        };
    },
    computed: {
        ...mapState(["reservas", "elementos", "habitacion"]),
        cargar() {
            this.config.list.rows = this.habitacion.habitaciones;
            this.config.chart.items = this.elementos;
        }
    },

    methods: {
        newModal() {
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
        setTimeout(() => this.cargar, 1200);
        this.$Progress.finish();
    },
    beforeDestroy() {
        subs.forEach(unsub => unsub());
    }
};
</script>
