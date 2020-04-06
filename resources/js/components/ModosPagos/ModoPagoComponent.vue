<template>
  <div>
    <div class="row">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <button class="btn-success float-right" @click="newModal">Agregar nuevo</button>
            <h5>Modos de pagos</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Modo de pago</th>
                  <th>Cantidad de pagos</th>
                  <th>Descripcion</th>
                  <th>Fecha de creacion</th>
                  <th>fecha de modificacion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in modosPagos.data" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.modoPago | capitalize}}</td>
                  <td>{{ item.cantidadPagos }}</td>
                  <td>{{ item.descripcion | capitalize}}</td>
                  <td>{{ item.created_at }}</td>
                  <td>{{ item.updated_at}}</td>
                  <td>
                    <button @click="editModal(item)" class="btn">
                      <i class="fa fa-edit blue"></i>
                    </button>
                    |
                    <button class="btn" @click="deleteModoPago(item.id)">
                      <i class="fa fa-trash red"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="modosPagos" :limit="3" @pagination-change-page="getResults"></pagination>
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
              v-text="editMode ? 'Modificar' : 'Agregar'"
            ></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editMode ? updateModoPago() : createModoPago()">
            <div class="modal-body">
              <div class="form-group">
                <label>Modo de pago</label>
                <input
                  v-model="form.modoPago"
                  type="text"
                  name="modoPago"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('modoPago') }"
                />
                <has-error :form="form" field="modoPago"></has-error>
              </div>

                <div class="form-group">
                <label>Cantidad de pagos</label>
                <input
                  v-model="form.cantidadPagos"
                  type="number"
                  name="cantidadPagos"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('cantidadPagos') }"
                />
                <has-error :form="form" field="cantidadPagos"></has-error>
              </div>

                <div class="form-group">
                <label>Descripcion</label>
                <input
                  v-model="form.descripcion"
                  type="text"
                  name="descripcion"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('descripcion') }"
                />
                <has-error :form="form" field="descripcion"></has-error>
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
      modosPagos: {},
      form: new Form({
        id: "",
        modoPago: "",
        cantidadPagos: "",
        descripcion: "",
      }),
    };
  },
  created() {
    this.loadModosPagos();
  },
  methods: {
    createModoPago() {
      this.$Progress.start();
      this.form
        .post("modoPago")
        .then(() => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Modo de pago creado correctamente"
          });
          this.$Progress.finish();
          this.loadModosPagos();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Error"
          });
        });
    },
    loadModosPagos() {
      axios.get("modoPago").then(res => (this.modosPagos = res.data));
    },
    deleteModoPago(id) {
      Swal.fire({
        title: "¿Esta seguro que desea eliminar este modo de pago?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("modoPago/" + id)
            .then(() => {
              this.loadModosPagos();
              Swal.fire(
                "Eliminado!",
                "Se elimino correctamente.",
                "success"
              );
            })
            .catch(() => {
              Swal.fire("Error!", "No se pudo eliminar", "error");
            });
        }
      });
    },
    newModal() {
      this.editMode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    editModal(modoPago) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(modoPago);
    },

    updateModoPago() {
      this.$Progress.start();
      this.form
        .put("modoPago/" + this.form.id)
        .then(res => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Modo de pago actualizado correctamente"
          });
          this.$Progress.finish();
          this.loadModosPagos();
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
      axios.get("modoPago?page=" + page).then(res => {
        this.modosPagos = res.data;
      });
    }
  }
};
</script>


<style lang="stylus" scoped></style>


