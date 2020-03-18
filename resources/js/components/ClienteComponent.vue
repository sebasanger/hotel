|<template>
  <div>
    <form @submit.prevent="editarCliente(cliente)" v-if="modoEditar && !modoCrear" class="col-md-8">
      <h3>Editar cliente</h3>
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

    <form @submit.prevent="agregar" v-if="!modoEditar && modoCrear">
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
      <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
    </form>

    <button
      class="btn btn-info mb-2"
      @click="modoAgregar"
      v-if="!modoCrear && !modoEditar"
    >Agregar nuevo</button>
    <table
      class="table table-striped table-hover table-dark col-md-12"
      v-if="!modoCrear && !modoEditar"
    >
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">dni</th>
          <th scope="col">Celular</th>
          <th scope="col">Procedencia</th>
          <th scope="col">Domicilio</th>
          <th scope="col">Destino</th>
          <th scope="col">Profecion</th>
          <th scope="col">Agregado</th>
          <th scope="col">Modificado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in clientes" :key="index">
          <td>{{ item.nombre }}</td>
          <td>{{ item.apellido }}</td>
          <td>{{ item.dni }}</td>
          <td>{{ item.celular }}</td>
          <td>{{ item.procedencia }}</td>
          <td>{{ item.domicilio }}</td>
          <td>{{ item.destino }}</td>
          <td>{{ item.profecion }}</td>
          <td>{{ item.created_at }}</td>
          <td>{{ item.updated_at }}</td>

          <button class="btn btn-warning btn-sm mt-2" @click="editarFormulario(item)">Editar</button>
          <button class="btn btn-danger btn-sm ml-1 mt-2" @click="eliminarCliente(item, index)">X</button>
        </tr>
      </tbody>
    </table>
    <ul class="pagination" v-if="!modoCrear && !modoEditar">
      <li class="page-item" v-if="paginacion.current_page > 1">
        <a class="page-link" href="#" @click.prevent="changePage(paginacion.current_page - 1)">
          <span>Atras</span>
        </a>
      </li>

      <li
        class="page-item"
        v-for="page in pagesNumber"
        :key="page.id"
        :class="[ page == isActived ? 'active' : '' ]"
      >
        <a class="page-link" href="#" @click.prevent="changePage(page)">
          <span>{{ page }}</span>
        </a>
      </li>

      <li class="page-item" v-if="paginacion.current_page < paginacion.last_page">
        <a class="page-link" href="#" @click.prevent="changePage(paginacion.current_page + 1)">
          <span>Siguiente</span>
        </a>
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
      modoCrear: false,
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
      },
      paginacion: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 1
    };
  },
  created() {
    this.cargarClientes();
  },

  methods: {
    cargarClientes(page) {
      var urlClienjte = "cliente?page=" + page;
      axios.get(urlClienjte).then(res => {
        this.clientes = res.data.data;
        this.paginacion = res.data;
      });
    },
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
          const clienteCreado = res.data;
          this.cargarClientes();
          this.limpiar();
          this.cancelar();
        } else {
          swal("Cliente no creado", "No se puedo crear el cliente", "error");
        }
      });
    },
    editarFormulario(item) {
      this.cliente.nombre = item.nombre;
      this.cliente.apellido = item.apellido;
      this.cliente.dni = item.dni;
      this.cliente.celular = item.celular;
      this.cliente.profecion = item.profecion;
      this.cliente.domicilio = item.domicilio;
      this.cliente.procedencia = item.procedencia;
      this.cliente.destino = item.destino;
      this.cliente.id = item.id;
      this.modoEditar = true;
    },
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
          this.modoEditar = false;
          const index = this.clientes.findIndex(item => item.id === cliente.id);
          this.clientes[index] = res.data;
          this.limpiar();
          swal(
            "Cliente editado",
            "Cliente actualizado correctamente",
            "success"
          );
        } else {
          swal("Cliente no editado", "No se puedo editar el cliente", "error");
        }
      });
    },
    eliminarCliente(cliente, index) {
      swal({
        title: "¿Esta seguro que desea eliminar el cliente?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.delete(`/cliente/${cliente.id}`).then(res => {
            console.log(res);
            if (res.status === 200) {
              this.clientes.splice(index, 1);
            } else {
              alert("No se pudo eliminar el cliente");
            }
          });
          swal("Cliente eliminado correctamente", {
            icon: "success"
          });
        } else {
          swal("No se pudo eliminar el cliente", {
            icon: "error"
          });
        }
      });
    },
    cancelar() {
      this.modoEditar = false;
      this.modoCrear = false;
      this.limpiar();
    },
    limpiar() {
      this.cliente = {
        id: "",
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
    modoAgregar() {
      this.modoCrear = true;
    },
    changePage(page) {
      this.paginacion.current_page = page;
      this.cargarClientes(page);
    }
  },
  computed: {
    isActived() {
      return this.paginacion.current_page;
    },
    pagesNumber() {
      if (!this.paginacion.to) {
        return [];
      }
      var from = this.paginacion.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset;
      if (to < this.paginacion.last_page) {
        to = this.paginacion.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  }
};
</script>
