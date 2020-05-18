<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <button
                            class="btn-info text-white float-right"
                            @click="newModal"
                        >
                            Agregar nueva
                        </button>
                        <h5>Categorias de productos</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Fecha de creacion</th>
                                    <th>fecha de modificacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in categorias.data"
                                    :key="item.id"
                                >
                                    <td>{{ item.categoria | capitalize }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <button
                                            @click="editModal(item)"
                                            class="btn"
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>

                                        <button
                                            class="btn ml-2"
                                            @click="deleteCategoria(item.id)"
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
                            :data="categorias"
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
                            editMode ? updateCategoria() : createCategoria()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Categoria</label>
                                <input
                                    v-model="form.categoria"
                                    type="text"
                                    name="categoria"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'categoria'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="categoria"
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
            categorias: {},
            form: new Form({
                id: "",
                categoria: ""
            })
        };
    },
    created() {
        this.loadCategorias();
    },
    methods: {
        createCategoria() {
            this.$Progress.start();
            this.form
                .post("categoria")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Categoria creada correctamente"
                    });
                    this.$Progress.finish();
                    this.loadCategorias();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        loadCategorias() {
            axios
                .get("categoria")
                .then(res => {
                    this.categorias = res.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        },
        deleteCategoria(id) {
            Swal.fire({
                title:
                    "¿Esta seguro que desea eliminar esta categoria de producto?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("categoria/" + id)
                        .then(() => {
                            this.loadCategorias();
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

        editModal(categoria) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(categoria);
        },

        updateCategoria() {
            this.$Progress.start();
            this.form
                .put("categoria/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Categoria actualizada correctamente"
                    });
                    this.$Progress.finish();
                    this.loadCategorias();
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
            axios.get("categoria?page=" + page).then(res => {
                this.categorias = res.data;
            });
        }
    }
};
</script>

<style lang="stylus" scoped></style>
