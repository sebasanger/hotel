<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <div class="select-chart">
                    <label>Año:</label>
                    <select v-model.number="year" @change="cargar()">
                        <option
                            v-for="(y, index) in yearSelect"
                            :key="index"
                            :value="y"
                            >{{ y }}</option
                        >
                    </select>
                </div>
                <h2 class="text-center ">
                    Ingreso de reservas mensual
                </h2>
                <chart-line
                    v-if="loaded"
                    :chart-data="chartData"
                    :options="options"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ChartLine from "../ChartLine.vue";
import moment from "moment";
export default {
    name: "ingresoMensual",
    components: { ChartLine },
    data() {
        return {
            year: "",
            yearSelect: [],
            loaded: false,
            reservas: [],
            loaded: false,
            chartData: null,
            options: {
                scales: {
                    xAxes: [
                        {
                            scaleLabel: {
                                display: true,
                                labelString: "Dia"
                            },
                            type: "time",
                            time: {
                                unit: "month"
                            },
                            distribution: "linear"
                        }
                    ],
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            },
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: "Cantidad de ingresos"
                            }
                        }
                    ]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        };
    },
    async mounted() {
        this.year = moment().format("YYYY");
        let y = this.year;
        for (let index = 0; index <= 5; index++) {
            this.yearSelect[index] = y;
            y--;
        }
        this.cargar();
    },
    methods: {
        async cargar() {
            this.loaded = false;
            this.chartData = null;
            this.reservas = [];
            try {
                const res = await axios.get(
                    "/getReservasMensuales/" + this.year
                );

                res.data.forEach(element => {
                    this.reservas.push({
                        x: moment()
                            .date(1)
                            .month(element.month - 1)
                            .year(element.year)
                            .format("YYYY-MM-DD"),
                        y: element.cantidad
                    });
                });
                this.chartData = {
                    datasets: [
                        {
                            label: "Ingresos",
                            backgroundColor: "rgba(255, 50, 20, 0.3)",
                            borderColor: "rgba(255, 50, 20, 0.6)",
                            borderWidth: 1,
                            data: this.reservas,
                            pointRadius: 5,
                            pointBorderColor: "white"
                        }
                    ]
                };
                this.loaded = true;
            } catch (e) {
                console.error(e);
            }
        }
    }
};
</script>
