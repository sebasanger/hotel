<template>
  <div>
    <form @submit.prevent="editarNota(cliente)" v-if="modoEditar">
      <h3>Editar nota</h3>
      <input type="text" class="form-control mb-2" placeholder="Nombre" v-model="cliente.nombre" />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Apellido"
        v-model="cliente.apellido"
      />
      <input type="number" class="form-control mb-2" placeholder="Documento" v-model="cliente.dni" />
      <input type="email" class="form-control mb-2" placeholder="Email" v-model="cliente.email" />
      <input
        type="number"
        class="form-control mb-2"
        placeholder="celular"
        v-model="cliente.celular"
      />
      <button class="btn btn-warning" type="submit">Editar</button>
      <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar</button>
    </form>

    <form @submit.prevent="agregar" v-else>
      <h3>Agregar cliente</h3>
      <input type="text" class="form-control mb-2" placeholder="Nombre" v-model="cliente.nombre" />
      <input
        type="text"
        class="form-control mb-2"
        placeholder="Apellido"
        v-model="cliente.apellido"
      />
      <input type="number" class="form-control mb-2" placeholder="Documento" v-model="cliente.dni" />
      <input type="email" class="form-control mb-2" placeholder="Email" v-model="cliente.email" />
      <input
        type="number"
        class="form-control mb-2"
        placeholder="celular"
        v-model="cliente.celular"
      />
      <button class="btn btn-primary" type="submit">Agregar</button>
    </form>
    <hr />
    <h3>Lista de clientes:</h3>
    <ul class="list-group">
      <li class="list-group-item" v-for="(item, index) in clientes" :key="index">
        <span class="badge badge-primary float-right">{{item.updated_at}}</span>
        <p>{{item.nombre}}</p>
        <p>{{item.apellido}}</p>
        <p>{{item.dni}}</p>
        <p>{{item.email}}</p>
        <p>{{item.celular}}</p>
        <p>
          <button class="btn btn-warning btn-sm" @click="editarFormulario(item)">Editar</button>
          <button class="btn btn-danger btn-sm" @click="eliminarNota(item, index)">Eliminar</button>
        </p>
      </li>
    </ul>
  </div>
</template>


<script>
export default {
  data() {
    return {
      clientes: [],
      modoEditar: false,
      cliente: {
        id: "",
        nombre: "",
        appelldio: "",
        dni: "",
        email: "",
        telefono: "",
        celular: ""
      }
    };
  },
  created() {
    axios.get("/cliente").then(res => {
      this.clientes = res.data;
    });
  },
  methods: {
    agregar() {
      if (
        this.cliente.nombre.trim() === "" ||
        this.cliente.apellido.trim() === "" ||
        this.cliente.dni.trim() === "" ||
        this.cliente.telefono.trim() === "" ||
        this.cliente.celular.trim() === "" ||
        this.cliente.email.trim() === ""
      ) {
        alert("Debes completar todos los campos antes de guardar");
        return;
      }
      const clienteNuevo = this.cliente;

      axios.post("/cliente", clienteNuevo).then(res => {
        if (res.status === 201) {
          const clienteCreado = res.data;
          this.clientes.push(clienteCreado);
          alert("Cliente creado");

          this.limpiar();

        } else {
          alert("No se pudo crear el cliente");
        }
      });
    },
    editarFormulario(item) {
      this.cliente.nombre = item.nombre;
      this.cliente.apellido = item.apellido;
      this.cliente.dni = item.dni;
      this.cliente.celular = item.celular;
      this.cliente.email = item.email;
      this.cliente.id = item.id;
      this.modoEditar = true;
    },
    editarNota(cliente) {
      const params = {
        id: this.cliente.id,
        nombre: this.cliente.nombre,
        apellido: this.cliente.apellido,
        dni: this.cliente.dni,
        email: this.cliente.email,
        celular: this.cliente.celular
      };
      axios.put(`/cliente/${cliente.id}`, params).then(res => {
        this.modoEditar = false;
        const index = this.clientes.findIndex(item => item.id === cliente.id);
        this.clientes[index] = res.data;
        this.limpiar();
      });
    },
    eliminarNota(cliente, index) {
      const confirmacion = confirm(
        `¿Esta seguro desea eliminar al cliente ${cliente.nombre} ${cliente.apellido}?`
      );
      if (confirmacion) {
        axios.delete(`/cliente/${cliente.id}`).then(res => {
          console.log(res);
          if (res.status === 200) {
            this.clientes.splice(index, 1);
            alert("Cliente eliminado");
          } else {
            alert("No se pudo eliminar el cliente");
          }
        });
      }
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.limpiar();
    },
    limpiar(){
      this.cliente = {
        nombre: "",
        apellido: "",
        dni: "",
        telefono: "",
        celular: "",
        email: ""
      };
    }
  }
};
</script>