|<template>
  <div>

    <router-link to="agregar/cliente">
      <button class="btn btn-info btn-primary mb-2">Agregar nuevo</button>
    </router-link>
    <table class="table table-striped table-hover table-dark col-md-12">
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

          <button class="btn btn-warning btn-sm mt-2">Editar</button>

          <button class="btn btn-danger btn-sm ml-1 mt-2" @click="eliminarCliente(item, index)">X</button>
        </tr>
      </tbody>
    </table>
    <ul class="pagination">
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
      var from = this.paginacion.current_page - 3;
      if (from < 1) {
        from = 1;
      }
      var to = from + 7;
      if (to >= this.paginacion.last_page) {
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
