<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <button class="btn-success float-right" @click="newModal">Agregar cliente</button>
            <div class="input-group input-group-sm" style="width: 200px;">
              <input
                autocomplete="off"
                type="text"
                name="table_search"
                class="form-control float-lg-left"
                placeholder="Nombre, apellido, email..."
                v-model="search"
                @keydown="buscar()"
              />
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>DNI</th>
                  <th>Nombre y apellido</th>
                  <th>Celular</th>
                  <th>Domicio</th>
                  <th>Destino</th>
                  <th>Procedencia</th>
                  <th>Profecion</th>
                  <th>Factura</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in clientes.data" :key="item.id">
                  <td>{{ item.dni }}</td>
                  <td>{{ item.nombre +" "+ item.apellido | capitalize}}</td>
                  <td>{{ item.celular }}</td>
                  <td>{{ item.domicilio | capitalize}}</td>
                  <td>{{ item.destino | capitalize}}</td>
                  <td>{{ item.procedencia | capitalize}}</td>
                  <td>{{ item.profecion | capitalize}}</td>
                  <td>{{ item.tipoFactura | capitalize}}</td>
                  <td>
                    <button @click="editModal(item)" class="btn">
                      <i class="fa fa-edit blue"></i>
                    </button>
                    |
                    <button class="btn" @click="deleteCliente(item.id)">
                      <i class="fa fa-trash red"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer" v-show="!search">
            <pagination :data="clientes" :limit="3" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNew"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="addNew"
              v-text="editMode ? 'Editar cliente' : 'Crear cliente'"
            ></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editMode ? updateCliente() : createCliente()">
            <div class="modal-body">
              <div class="form-group">
                <label>Nombre</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  name="nombre"
                  required
                  placeholder="Nombre"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('nombre') }"
                />
                <has-error :form="form" field="nombre"></has-error>
              </div>

              <div class="form-group">
                <label>Apellido</label>
                <input
                  v-model="form.apellido"
                  type="text"
                  name="apellido"
                  required
                  placeholder="Apellido"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('apellido') }"
                />
                <has-error :form="form" field="apellido"></has-error>
              </div>

              <div class="form-group">
                <label>DNI</label>
                <input
                  v-model="form.dni"
                  type="number"
                  name="dni"
                  placeholder="dni"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('dni') }"
                />
                <has-error :form="form" field="dni"></has-error>
              </div>

              <div class="form-group">
                <label>Celular</label>
                <input
                  v-model="form.celular"
                  type="number"
                  name="celular"
                  placeholder="Celular"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('celular') }"
                />
                <has-error :form="form" field="celular"></has-error>
              </div>

              <div class="form-group">
                <label>Domicilio</label>
                <input
                  v-model="form.domicilio"
                  type="text"
                  name="domicilio"
                  placeholder="Domicilio"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('domicilio') }"
                />
                <has-error :form="form" field="domicilio"></has-error>
              </div>

              <div class="form-group">
                <label>Destino</label>
                <input
                  v-model="form.destino"
                  type="text"
                  name="destino"
                  placeholder="Destino"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('destino') }"
                />
                <has-error :form="form" field="destino"></has-error>
              </div>

              <div class="form-group">
                <label>Procedencia</label>
                <input
                  v-model="form.procedencia"
                  type="text"
                  name="procedencia"
                  placeholder="Procedencia"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('procedencia') }"
                />
                <has-error :form="form" field="procedencia"></has-error>
              </div>

              <div class="form-group">
                <label>Profecion</label>
                <input
                  v-model="form.profecion"
                  type="text"
                  name="profecion"
                  placeholder="Profecion"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('profecion') }"
                />
                <has-error :form="form" field="profecion"></has-error>
              </div>

              <div class="form-group">
                <label>Factura</label>
                <select
                  v-model="form.facturas_id"
                  name="facturas_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('facturas_id') }"
                >
                  <option value>Seleccionar una factura</option>
                  <option v-for="(f,index) in facturas" :key="index" :value="f.id">{{ f.tipoFactura}}</option>

                </select>
                <has-error :form="form" field="facturas_id"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button v-if="!editMode" type="submit" class="btn btn-success">Guardar</button>
              <button v-if="editMode" type="submit" class="btn btn-success">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editMode: false,
      clientes: {},
      search: "",
      facturas: [],
      form: new Form({
        id: "",
        nombre: "",
        apellido: "",
        dni: "",
        facturas_id: "",
        celular: "",
        domicilio: "",
        destino: "",
        procedencia: "",
        profecion: ""
      }),

    };
  },
  created() {
    this.loadClientes();
    this.loadFacturas();
  },
  methods: {
    createCliente() {
      this.$Progress.start();
      this.form
        .post("cliente")
        .then(() => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Cliente creado correctamente"
          });
          this.$Progress.finish();
          this.loadClientes();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Error"
          });
        });
    },
    loadClientes() {
      axios.get("cliente").then(res => (this.clientes = res.data));
    },
    loadFacturas() {
      axios.get("factura").then(res => (this.facturas = res.data.data));
    },
    deleteCliente(id) {
      Swal.fire({
        title: "¿Esta seguro que desea eliminar este cliente?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("cliente/" + id)
            .then(() => {
              this.loadClientes();
              Swal.fire(
                "Eliminado!",
                "El cliente se elimino correctamente.",
                "success"
              );
            })
            .catch(() => {
              Swal.fire("Error!", "No se pudo eliminar el cliente", "error");
            });
        }
      });
    },
    newModal() {
      this.editMode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    editModal(cliente) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(cliente);
    },

    updateCliente() {
      this.$Progress.start();
      this.form
        .put("cliente/" + this.form.id)
        .then(res => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Cliente actualizado correctamente"
          });
          this.$Progress.finish();
          this.loadClientes();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Error"
          });
        });
    },
    getResults(page = 1) {
      axios.get("cliente?page=" + page).then(res => {
        this.clientes = res.data;
      });
    },
    //se busca cada cierto tiempo lo que ponemos en el filtro con la funcion debounce
    buscar: _.debounce(function() {
      this.filter();
    }, 50),

    //llama a la ruta find cliente
    filter() {
      let query = this.search;
      axios.get("findCliente/" + query).then(res => {
        this.clientes = res.data;
      });
    }
  }
};
</script>


<style lang="stylus" scoped></style>


