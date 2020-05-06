<template>
    <div class="container-fluid text-white">
        <div class="row row-cols-4" style="height: 40px">
            <div class="col-3 float-right">Dolar: {{ dolar.compra }}</div>
            <hr />
            <div class="col-3 float-right">Real: {{ real.compra }}</div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dolar: [],
            real: []
        };
    },
    mounted() {
        //precio del dolar a la api de dolarsi
        axios
            .get("https://www.dolarsi.com/api/api.php?type=dolar")
            .then(res => {
                this.dolar = res.data[1].casa;
            })
            .catch(() => {
                this.dolar = "N/I";
            });

        //precio del real a la api de dolarsi
        axios
            .get("https://www.dolarsi.com/api/api.php?type=real")
            .then(res => {
                this.real = res.data[1].casa;
            })
            .catch(() => {
                this.dolar = "N/I";
            });
    }
};
</script>
