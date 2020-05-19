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
                <div class="select-chart">
                    <label>Mes:</label>
                    <select v-model.number="month" @change="cargar()">
                        <option
                            v-for="m in monthselect"
                            :key="m.id"
                            :value="m.id"
                            >{{ m.month }}</option
                        >
                    </select>
                </div>
                <h2 class="text-center">
                    Ingreso de reservas diario
                </h2>

                <chart-line
                    v-if="loaded"
                    :chartData="chartData"
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
    name: "LineChartContainer",
    components: { ChartLine },
    data() {
        return {
            reservasData: [],
            year: "",
            month: "",
            yearSelect: [],
            monthselect: [],
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
                                unit: "day"
                            },
                            distribution: "linear"
                        }
                    ],
                    yAxes: [
                        {
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
    mounted() {
        this.year = moment().format("YYYY");
        this.month = moment().format("M");
        let y = this.year;
        for (let index = 0; index <= 5; index++) {
            this.yearSelect[index] = y;
            y--;
        }
        let m = moment.months();
        let i = 1;
        for (let index = 0; index <= 11; index++) {
            this.monthselect[index] = {
                id: i,
                month: m[index]
            };
            i++;
        }
        this.cargar();
    },
    methods: {
        async cargar() {
            this.loaded = false;
            this.chartData = null;
            this.saldos = [];
            try {
                const res = await axios.get(
                    "/getReservasDiarias/" + this.year + "/" + this.month
                );

                res.data.forEach(element => {
                    this.saldos.push({
                        x: moment(element.date).format("YYYY-MM-DD"),
                        y: element.cantidad
                    });
                });
                this.chartData = {
                    datasets: [
                        {
                            label: "Ingresos",
                            backgroundColor: "rgba(255, 50, 20, 0.3)",
                            borderColor: "rgba(255, 50, 20, 0.8)",
                            borderWidth: 1,
                            data: this.saldos,
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
