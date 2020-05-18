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
import ChartBar from "./ChartBar.vue";

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
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        defaultFontColor: "#212"
                    }
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
                        hoverBackgroundColor: "rgba(255, 50, 15, 0.9)",
                        label: "Stock",
                        backgroundColor: "rgba(255, 45, 12, 0.7)",
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
