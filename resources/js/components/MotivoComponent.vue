<template>
  <div>
    <div class="row">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <button class="btn-success float-right" @click="newModal">Agregar nuevo</button>
            <h5>Motivos de la estadia</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Motivo</th>
                  <th>Fecha de creacion</th>
                  <th>fecha de modificacion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in motivos.data" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.motivo | capitalize}}</td>
                  <td>{{ item.created_at }}</td>
                  <td>{{ item.updated_at}}</td>
                  <td>
                    <button @click="editModal(item)" class="btn">
                      <i class="fa fa-edit blue"></i>
                    </button>
                    |
                    <button class="btn" @click="deleteMotivo(item.id)">
                      <i class="fa fa-trash red"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="motivos" :limit="3" @pagination-change-page="getResults"></pagination>
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
          <form @submit.prevent="editMode ? updateMotivo() : createMotivo()">
            <div class="modal-body">
              <div class="form-group">
                <label>Motivo</label>
                <input
                  v-model="form.motivo"
                  type="text"
                  name="motivo"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('motivo') }"
                />
                <has-error :form="form" field="motivo"></has-error>
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
      motivos: {},
      form: new Form({
        id: "",
        motivo: "",
      }),
    };
  },
  created() {
    this.loadMotivos();
  },
  methods: {
    createMotivo() {
      this.$Progress.start();
      this.form
        .post("motivo")
        .then(() => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Motivo creado correctamente"
          });
          this.$Progress.finish();
          this.loadMotivos();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Error"
          });
        });
    },
    loadMotivos() {
      axios.get("motivo").then(res => (this.motivos = res.data));
    },
    deleteMotivo(id) {
      Swal.fire({
        title: "¿Esta seguro que desea eliminar este motivo de estadia?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("motivo/" + id)
            .then(() => {
              this.loadMotivos();
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

    editModal(motivo) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(motivo);
    },

    updateMotivo() {
      this.$Progress.start();
      this.form
        .put("motivo/" + this.form.id)
        .then(res => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Motivo actualizado correctamente"
          });
          this.$Progress.finish();
          this.loadMotivos();
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
      axios.get("motivo?page=" + page).then(res => {
        this.motivos = res.data;
      });
    }
  }
};
</script>


<style lang="stylus" scoped></style>


