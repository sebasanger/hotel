<template>
  <div>
    <table
      class="table table-striped table-hover table-dark col-md-12"
      v-if="!modoCrear && !modoEditar"
    >
      <thead>
        <tr>
          <th scope="col">Factura</th>
          <th scope="col">Creado</th>
          <th scope="col">Modificado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in facturas" :key="index">
          <td>{{ item.tipoFactura }}</td>
          <td>{{ item.created_at }}</td>
          <td>{{ item.updated_at }}</td>

          <button class="btn btn-warning btn-sm mt-2" @click="editarFormulario(item)">Editar</button>
          <button class="btn btn-danger btn-sm ml-1 mt-2" @click="eliminarCliente(item, index)">X</button>
        </tr>
      </tbody>
    </table>
  </div>
</template>



<script>
export default {
  data() {
    return {
      facturas: [],
      factura: {}
    };
  },
  created() {
    axios.get("/factura").then(res => {
      this.facturas = res.data;
    });
  }
};
</script>