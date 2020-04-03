<template>
  <div>
    <div class="row">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <button class="btn-success float-right" @click="newModal">Agregar nueva</button>
            <h5>Tipos de facturas</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tipo de factura</th>
                  <th>Fecha de creacion</th>
                  <th>fecha de modificacion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in facturas.data" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.tipoFactura | capitalize}}</td>
                  <td>{{ item.created_at }}</td>
                  <td>{{ item.updated_at}}</td>
                  <td>
                    <button @click="editModal(item)" class="btn">
                      <i class="fa fa-edit blue"></i>
                    </button>
                    |
                    <button class="btn" @click="deleteFactura(item.id)">
                      <i class="fa fa-trash red"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="facturas" :limit="3" @pagination-change-page="getResults"></pagination>
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
          <form @submit.prevent="editMode ? updateFactura() : createFactura()">
            <div class="modal-body">
              <div class="form-group">
                <label>Tipo de factura</label>
                <input
                  v-model="form.tipoFactura"
                  type="text"
                  name="tipoFactura"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tipoFactura') }"
                />
                <has-error :form="form" field="tipoFactura"></has-error>
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
      facturas: {},
      form: new Form({
        id: "",
        tipoFactura: "",
      }),
    };
  },
  created() {
    this.loadFacturas();
  },
  methods: {
    createFactura() {
      this.$Progress.start();
      this.form
        .post("factura")
        .then(() => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Tipo de factura creada correctamente"
          });
          this.$Progress.finish();
          this.loadFacturas();
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Error"
          });
        });
    },
    loadFacturas() {
      axios.get("factura").then(res => (this.facturas = res.data));
    },
    deleteFactura(id) {
      Swal.fire({
        title: "¿Esta seguro que desea eliminar este tipo de factura?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("factura/" + id)
            .then(() => {
              this.loadFacturas();
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

    editModal(cliente) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(cliente);
    },

    updateFactura() {
      this.$Progress.start();
      this.form
        .put("factura/" + this.form.id)
        .then(res => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Cliente actualizado correctamente"
          });
          this.$Progress.finish();
          this.loadFacturas();
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
      axios.get("factura?page=" + page).then(res => {
        this.facturas = res.data;
      });
    }
  }
};
</script>


<style lang="stylus" scoped></style>


