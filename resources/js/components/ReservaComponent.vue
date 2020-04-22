<template>
    <div id="app">
        <GSTC :config="config" @state="onState" @click="console.log(config)" />
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
        ...mapState(["reservas", "elementos", "habitaciones"]),
        cargar() {
            this.config.list.rows = this.habitaciones;
            this.config.chart.items = this.elementos;
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
        }
    },

    created() {
        router = this.$router;
    },

    mounted() {
        this.cargar;
        this.$Progress.finish();
    },
    beforeDestroy() {
        subs.forEach(unsub => unsub());
    }
};
</script>
