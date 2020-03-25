|<template>
  <div>
    <router-link to="/agregar/cliente">
      <button class="btn btn-info btn-primary mb-2">Agregar nuevo</button>
    </router-link>

    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">Nombres</th>
          <th scope="col">Apellidos</th>
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
        <tr v-for="(item, index) in clientes" :key="item.id">
          <td>{{ item.nombre | capitalize}}</td>
          <td>{{ item.apellido | capitalize}}</td>
          <td>{{ item.dni }}</td>
          <td>{{ item.celular }}</td>
          <td>{{ item.procedencia | capitalize}}</td>
          <td>{{ item.domicilio | capitalize}}</td>
          <td>{{ item.destino | capitalize}}</td>
          <td>{{ item.profecion | capitalize}}</td>
          <td>{{ item.created_at }}</td>
          <td>{{ item.updated_at }}</td>

          <div class="btn-group mt-2">
            <router-link
              :to="{name: 'ClienteEdit', params: { id: item.id }}"
              class="btn btn-warning btn-sm"
            >Editar</router-link>

            <button class="btn btn-danger btn-sm ml-1" @click="eliminarCliente(item, index)">X</button>
          </div>
        </tr>
      </tbody>
    </table>

    <ul class="pagination justify-content-end">
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
    eliminarCliente(cliente, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
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
