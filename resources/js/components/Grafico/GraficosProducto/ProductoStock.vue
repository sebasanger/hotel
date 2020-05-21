<template>
    <div class="row" v-show="loaded">
        <div class="col-md-12">
            <div class="Chart">
                <h2 class="text-center">Stock de los productos</h2>
                <chart-bar
                    v-if="loaded"
                    :chartData="chartData"
                    :options="options"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ChartBar from "../ChartBar.vue";

export default {
    name: "LineChartContainer",
    components: { ChartBar },
    data() {
        return {
            data: [],
            labels: [],
            loaded: false,
            chartData: null,
            options: {
                scales: {
                    xAxes: [
                        {
                            scaleLabel: {
                                display: true,
                                labelString: "Producto"
                            }
                        }
                    ],
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            },
                            scaleLabel: {
                                display: true,
                                labelString: "Stock actual"
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
            const productos = await axios.get("/getAllProductos");
            productos.data.forEach(element => {
                this.data.push(element.stock);
                this.labels.push(element.producto);
            });
            this.chartData = {
                labels: this.labels,
                datasets: [
                    {
                        label: "Stock",
                        backgroundColor: "rgba(255, 0, 0, 0.3)",
                        hoverBackgroundColor: "rgba(255, 0, 0, 0.5)",
                        data: this.data
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
