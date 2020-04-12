<template>
  <div id="app">
    <GSTC :config="config" @state="onState" />
  </div>
</template>

<script>
import GSTC from "vue-gantt-schedule-timeline-calendar";
import CalendarScroll from "gantt-schedule-timeline-calendar/dist/CalendarScroll.plugin.js";

let subs = [];

export default {
  name: "app",
  components: {
    GSTC
  },
  data() {
    return {
      config: {
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
                start: new Date().getTime() + 4 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 5 * 24 * 60 * 60 * 1000
              }
            },
            "3": {
              id: "3",
              rowId: "2",
              label: "Item 3",
              time: {
                start: new Date().getTime() + 6 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 7 * 24 * 60 * 60 * 1000
              }
            },
            "4": {
              id: "4",
              rowId: "3",
              label: "Item 4",
              time: {
                start: new Date().getTime() + 10 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 12 * 24 * 60 * 60 * 1000
              }
            },
            "5": {
              id: "5",
              rowId: "4",
              label: "Item 5",
              time: {
                start: new Date().getTime() + 12 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 14 * 24 * 60 * 60 * 1000
              }
            }
          }
        }
      }
    };
  },
  methods: {
    onState(state) {
      this.state = state;
      subs.push(state.subscribe("config.chart.items", item => {}));
      subs.push(state.subscribe("config.list.rows", row => {}));
    },

    loadHabitaciones() {
      axios
        .get("habitacion")
        .then(res => (this.config.list.rows = res.data.data));
    },
    loadReservas() {
      axios.get("reserva").then(res => {
        res.data.forEach(element => {
          this.config.chart.items[element.id] = {
            id: element.id.toString(),
            rowId: element.habitaciones_id.toString(),
            label:
              element.nombre +
              " " +
              element.apellido +
              " " +
              element.numeroHabitacion,

            style: {
              background: element.color
            },
            time: {
              start: new Date(element.created_at).getTime(),
              end: new Date(element.egreso).getTime()
            }
          };
        });
      });
    }
  },

  mounted() {

    this.loadReservas();
    this.loadHabitaciones();
  },
  beforeDestroy() {
    subs.forEach(unsub => unsub());
  }
};
</script>

