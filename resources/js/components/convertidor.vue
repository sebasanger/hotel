<template>
  <div class="container-fluid text-white">
    <div class="row row-cols-4" style="height: 40px">
      <div class="col float-right">
        Dolar compra
        {{dolar.compra}}
      </div>

      <div class="col float-right">
        Dolar venta
        <p>{{dolar.venta}}</p>
      </div>

      <div class="col float-right">
        Real Compra
        {{real.compra}}
      </div>

      <div class="col float-right">
        Real precio venta
        {{real.venta}}
      </div>
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
    axios.get("https://www.dolarsi.com/api/api.php?type=dolar").then(res => {
      this.dolar = res.data[1].casa;
    });

    //precio del real a la api de dolarsi
    axios.get("https://www.dolarsi.com/api/api.php?type=real").then(res => {
      this.real = res.data[1].casa;
    });
  }
};
</script>
