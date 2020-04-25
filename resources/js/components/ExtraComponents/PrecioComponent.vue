<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button
                            class="btn-success float-right"
                            @click="newModal"
                        >
                            Agregar nuevo
                        </button>
                        <h5>Precios de la estadia</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de creacion</th>
                                    <th>fecha de modificacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in precios.data" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.precioHabitacion }}</td>
                                    <td>{{ item.descripcion | capitalize }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td>
                                        <button
                                            @click="editModal(item)"
                                            class="btn"
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>
                                        |
                                        <button
                                            class="btn"
                                            @click="deletePrecio(item.id)"
                                        >
                                            <i class="fa fa-trash red"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination
                            :data="precios"
                            :limit="3"
                            @pagination-change-page="getResults"
                        ></pagination>
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
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="
                            editMode ? updatePrecio() : createPrecio()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Precio por dia</label>
                                <input
                                    v-model="form.precioHabitacion"
                                    type="number"
                                    name="precioHabitacion"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'precioHabitacion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="precioHabitacion"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                                <input
                                    v-model="form.descripcion"
                                    type="text"
                                    name="descripcion"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'descripcion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="descripcion"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <button
                                v-if="!editMode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Guardar
                            </button>
                            <button
                                v-if="editMode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Actualizar
                            </button>
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
            precios: {},
            form: new Form({
                id: "",
                precioHabitacion: ""
            })
        };
    },
    created() {
        this.loadPrecios();
    },
    methods: {
        createPrecio() {
            this.$Progress.start();
            this.form
                .post("precioHabitacion")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Precio creado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadPrecios();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        loadPrecios() {
            axios
                .get("precioHabitacion")
                .then(res => {
                    this.precios = res.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        },
        deletePrecio(id) {
            Swal.fire({
                title:
                    "¿Esta seguro que desea eliminar este precio de estadia?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("precioHabitacion/" + id)
                        .then(() => {
                            this.loadPrecios();
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

        editModal(precio) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(precio);
        },

        updatePrecio() {
            this.$Progress.start();
            this.form
                .put("precioHabitacion/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Precio actualizado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadPrecios();
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
            axios.get("precioHabitacion?page=" + page).then(res => {
                this.precios = res.data;
            });
        }
    }
};
</script>

<style lang="stylus" scoped></style>
