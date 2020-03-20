<template>
  <div>
    <form @submit.prevent="agregar">
      <h3>Agregar cliente</h3>
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

      <button class="btn btn-primary btn-success" type="submit">Agregar</button>
      <button class="btn btn-danger"  @click="cancelar">Cancelar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cliente: {
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
    this.limpiar();
  },

  methods: {
    agregar() {
      if (
        this.cliente.nombre.trim() === "" ||
        this.cliente.apellido.trim() === "" ||
        this.cliente.dni.trim() === ""
      ) {
        swal(
          "Faltan datos",
          "El dni, nombre y apellido son olbigatorios",
          "warning"
        );
        return;
      }
      const clienteNuevo = this.cliente;

      axios.post("/cliente", clienteNuevo).then(res => {
        if (res.status === 201) {
          swal("Cliente creado", "Se creo correctamente el cliente", "success");
          this.home();
        } else {
          swal("Cliente no creado", "No se puedo crear el cliente", "error");
        }
      });
    },
    cancelar() {
      this.home();
    },
    limpiar() {
      this.cliente = {
        nombre: "",
        appelldio: "",
        dni: "",
        profecion: "",
        telefono: "",
        celular: "",
        procedencia: "",
        destino: "",
        domicilio: ""
      };
    },
    home() {
      this.$router.push("/cliente");
    }
  }
};
</script>
