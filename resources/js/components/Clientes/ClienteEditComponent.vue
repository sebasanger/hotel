|<template>
  <div>
    <h3>Editar cliente</h3>
    <form @submit.prevent="editarCliente(cliente)" class="col-md-8">
      <input
        type="text"
        class="form-control mb-2"
        required
        placeholder="Nombre"
        v-model="cliente.nombre"
      />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Apellido"
        required
        v-model="cliente.apellido"
      />
      <input
        type="number"
        class="form-control mb-2"
        placeholder="Documento"
        required
        v-model="cliente.dni"
      />
      <input
        type="number"
        class="form-control mb-2"
        placeholder="celular"
        v-model="cliente.celular"
      />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Procedencia"
        v-model="cliente.procedencia"
      />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Domicilio"
        v-model="cliente.domicilio"
      />
      <input type="text" class="form-control mb-2" placeholder="Destino" v-model="cliente.destino" />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Profecion"
        v-model="cliente.profecion"
      />
      <button class="btn btn-warning" type="submit">Editar</button>
      <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cliente: {
        id: "",
        nombre: "",
        appelldio: "",
        dni: "",
        telefono: "",
        celular: "",
        procedencia: "",
        destino: "",
        profecion: "",
        domicilio: ""
      }
    };
  },
  created() {
    axios.get(`/cliente/${this.$route.params.id}`).then(res => {
      this.cliente = res.data;
    });
  },
 

  methods: {
    editarCliente(cliente) {
      const params = {
        id: this.cliente.id,
        nombre: this.cliente.nombre,
        apellido: this.cliente.apellido,
        dni: this.cliente.dni,
        profecion: this.cliente.profecion,
        celular: this.cliente.celular,
        procedencia: this.cliente.procedencia,
        domicilio: this.cliente.domicilio,
        destino: this.cliente.destino
      };
      axios.put(`/cliente/${cliente.id}`, params).then(res => {
        if (res.status === 200) {
          this.back();
          swal(
            "Cliente editado",
            "Cliente actualizado correctamente",
            "success"
          );
        } else {
          this.back();
          swal("Cliente no editado", "No se puedo editar el cliente", "error");
        }
      });
    },
    back() {
      this.$router.push("/clientes");
    },

    cancelar() {
      this.back();
    }
  }
};
</script>
