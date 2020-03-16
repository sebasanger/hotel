<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Cajas</div>

          <div class="card-body">
            <h3 class="mt-2">Notas</h3>
            <ul class="list-group mt-2">
              <li class="list-group-item" v-for="(caja,index) in cajas" :key="index">
                <span class="badge badge-primary float-right">Hora de apertura: {{caja.created_at}}</span>
                <p>Monto de apertura: {{caja.montoApertura}}</p>
                <p>Hora de Cierre: {{caja.horaCierre}}</p>
                <p>Monto de cierre: {{caja.montoCierre}}</p>
                <p>Encargado: {{caja.users_id}}</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cajas: []
    };
  },
  mounted() {
    axios.get("/cajas").then(res => {
      this.cajas = res.data;
    });
  }
};
</script>
