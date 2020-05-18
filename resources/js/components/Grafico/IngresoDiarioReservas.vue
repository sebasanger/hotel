<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <h2 class="text-center">
                    Ingreso de reservas diario
                </h2>
                <!-- <span class="text-blue text-left">
                Del {{ dias[0] }} <br />
                Al {{ dias[dias.length - 1] }}</span
            > -->

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
import ChartLine from "./ChartBar.vue";
import moment from "moment";
export default {
    name: "LineChartContainer",
    components: { ChartLine },
    data() {
        return {
            reservasData: [],
            dias: [],
            loaded: false,
            chartData: null,
            options: {
                scales: {
                    xAxes: [
                        {
                            scaleLabel: {
                                display: true,
                                labelString: "Dias"
                            },
                            type: "time",
                            time: {
                                unit: "day"
                            }
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
        this.loaded = false;
        try {
            const res = await axios.get("/getReservasDiarias");
            res.data.forEach(element => {
                this.reservasData.push({
                    x: moment(element.date).format("YYYY-MM-DD"),
                    y: element.cantidad
                });
                this.dias.push(
                    moment(element.date)
                        .locale("es")
                        .format("LLLL")
                );
            });
            this.chartData = {
                labels: this.labels,
                datasets: [
                    {
                        hoverBorderColor: "red",
                        label: "Ingresos diarios",
                        backgroundColor: "rgba(88, 230, 249, 0.7)",
                        borderColor: "red",
                        borderWidth: 1,
                        data: this.reservasData
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
