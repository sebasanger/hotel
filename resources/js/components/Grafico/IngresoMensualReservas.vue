<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <h2 class="text-center ">
                    Ingreso de reservas mensual
                </h2>
                <label class="text-blue ml-2">Cantidad de meses</label>
                <select v-model.number="filtro" @change="cargar()">
                    <option v-for="(n, index) in 12" :key="index" :value="n">{{
                        n
                    }}</option>
                </select>
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
import ChartLine from "./ChartLine.vue";
import moment from "moment";
export default {
    name: "ingresoMensual",
    components: { ChartLine },
    data() {
        return {
            filtro: 6,
            data: [],
            labels: [],
            loaded: false,
            chartData: null,
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
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
        this.loaded = false;
        this.cargar();
    },
    methods: {
        async cargar() {
            try {
                this.loaded = false;
                this.chartData = null;
                this.data = [];
                this.labels = [];
                const reservas = await axios.get(
                    "/getReservasMensuales/" + this.filtro
                );
                reservas.data.forEach(element => {
                    this.data.push(element.cantidad);
                    this.labels.push(
                        moment()
                            .locale("es")
                            .month(element.date)
                            .format("MMMM") +
                            " " +
                            element.year
                    );
                });
                this.chartData = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: "Ingresos por mes",
                            backgroundColor: "rgba(80, 20, 220, 0.7)",
                            borderColor: "black",
                            borderWidth: 1.5,
                            data: this.data
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
