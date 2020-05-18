<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <h2 class="text-center">Saldo diario de caja</h2>
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
import chartLine from "./ChartLine.vue";
import moment from "moment";
export default {
    name: "cajaSaldo",
    components: { chartLine },
    data() {
        return {
            saldos: [],
            ingresosData: [],
            egresosData: [],
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
                                tooltipFormat: "LL"
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
            const res = await axios.get("/getSaldosDiarios");
            res.data.forEach(element => {
                this.saldos.push({
                    x: moment(element.date).format("YYYY-MM-DD"),
                    y: element.total
                });
            });
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
            });
            this.chartData = {
                datasets: [
                    {
                        label: "Saldo diario de caja",
                        backgroundColor: "rgba(55, 116, 255, 0.5)",
                        borderColor: "rgba(55, 116, 255, 0.8)",
                        borderWidth: 1,
                        data: this.saldos,
                        pointRadius: 5,
                        pointBorderColor: "green"
                    },
                    {
                        label: "Ingresos diarios",
                        backgroundColor: "rgba(39, 234, 133, 0.5)",
                        borderColor: "rgba(39, 234, 133, 0.8)",
                        borderWidth: 1,
                        data: this.ingresosData,
                        pointRadius: 5,
                        pointBorderColor: "green"
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
