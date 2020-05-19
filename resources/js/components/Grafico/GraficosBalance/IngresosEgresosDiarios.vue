<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <h2 class="text-center">Ingresos diarios</h2>
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
import { Line } from "vue-chartjs";
export default {
    name: "LineChartContainer",
    components: { ChartLine },
    data() {
        return {
            ingresosData: [],
            egresosData: [],
            gradient: null,
            gradient2: null,
            dias: [],
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
                                unit: "day",
                                tooltipFormat: "LLL"
                            },
                            distribution: "linear"
                        }
                    ],
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            },
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
        this.loaded = false;
        try {
            const ingresosRes = await axios.get("/getIngresosDiarios");
            ingresosRes.data.forEach(element => {
                if (element.tipo == 1) {
                    this.ingresosData.push({
                        x: moment(element.date).format("YYYY-MM-DD"),
                        y: element.total
                    });
                } else {
                    this.egresosData.push({
                        x: moment(element.date).format("YYYY-MM-DD"),
                        y: element.total
                    });
                }
                this.dias.push(
                    moment(element.date)
                        .locale("es")
                        .format("LLLL")
                );
            });
            this.chartData = {
                datasets: [
                    {
                        label: "Ingresos diarios",
                        pointBackgroundColor: "white",
                        borderWidth: 1,
                        pointBorderColor: "white",
                        backgroundColor: "rgba(39, 234, 133, 0.5)",
                        borderColor: "rgba(39, 234, 133, 0.8)",
                        data: this.ingresosData
                    },
                    {
                        label: "Egresos diarios",
                        stepped: true,
                        backgroundColor: "rgba(255, 0, 0, 0.5)",
                        borderColor: "rgba(255, 0, 0, 0.8)",
                        borderWidth: 1,
                        data: this.egresosData,
                        pointBorderColor: "red",
                        pointRadius: 5
                    }
                ]
            };
            this.loaded = true;
        } catch (e) {
            console.error(e);
        }
    }
};
</script>
