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
                <h2 class="text-center">Balance Mensual de caja</h2>
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
import chartLine from "../ChartLine.vue";
import moment from "moment";
export default {
    name: "cajaSaldo",
    components: { chartLine },
    data() {
        return {
            saldos: [],
            year: "",
            yearSelect: [],
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
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: "$$$"
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
            this.saldos = [];
            try {
                const res = await axios.get("/getSaldosMensuales/" + this.year);

                res.data.forEach(element => {
                    this.saldos.push({
                        x: moment()
                            .date(1)
                            .month(element.month - 1)
                            .year(element.year),
                        y: element.total
                    });
                });
                this.chartData = {
                    datasets: [
                        {
                            label: "Ganancia",
                            backgroundColor: "rgba(255, 50, 20, 0.3)",
                            borderColor: "rgba(255, 50, 20, 0.6)",
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
