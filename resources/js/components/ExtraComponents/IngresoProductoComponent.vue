<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div
                            class="input-group input-group-sm float-left pt-2"
                            style="width: 250px;"
                        >
                            <select
                                v-model="search"
                                name="categorias_id"
                                @change="buscar()"
                                class="form-control"
                            >
                                <option value>Filtrar por producto</option>
                                <option
                                    v-for="(p, index) in productos"
                                    :key="index"
                                    :value="p.id"
                                    >{{ p.producto }}</option
                                >
                            </select>
                        </div>
                        <button
                            class="btn-info text-white float-right"
                            @click="newModal"
                        >
                            Agregar ingreso
                        </button>
                        <h5>Ingresos de productos</h5>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad de ingreso</th>
                                    <th>Precio de compra</th>
                                    <th>Modo de pago</th>
                                    <th>Encargado</th>
                                    <th>Fecha</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in ingresosProductos.data"
                                    :key="item.id"
                                >
                                    <td>{{ item.producto }}</td>
                                    <td class="text-center">
                                        {{ item.cantidadIngreso }}
                                    </td>
                                    <td>
                                        {{ item.precioCompra | capitalize }}
                                    </td>
                                    <td>{{ item.modoPago }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        {{ item.created_at | formatDateTime }}
                                    </td>
                                    <td>
                                        <button
                                            class="btn"
                                            @click="
                                                deleteIngresoProducto(item.id)
                                            "
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
                            :data="ingresosProductos"
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
                            v-text="
                                editMode
                                    ? 'Editar el ingreso de producto id: ' +
                                      form.id
                                    : 'Crear ingreso de producto'
                            "
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
                            editMode
                                ? updateIngresoProducto()
                                : createIngresoProducto()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group" v-if="!editMode">
                                <label>Producto</label>
                                <select
                                    v-model="form.productos_id"
                                    name="productos_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'productos_id'
                                        )
                                    }"
                                >
                                    <option value
                                        >Seleccionar un producto</option
                                    >
                                    <option
                                        v-for="(p, index) in productos"
                                        :key="index"
                                        :value="p.id"
                                        >{{ p.producto }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="productos_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Precio de compra</label>
                                <input
                                    v-model="form.precioCompra"
                                    type="number"
                                    name="precioCompra"
                                    required
                                    placeholder="Precio de compra"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'precioCompra'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="precioCompra"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Cantidad</label>
                                <input
                                    v-model="form.cantidadIngreso"
                                    type="number"
                                    name="cantidadIngreso"
                                    placeholder="Cantidad de productos que ingresan"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'cantidadIngreso'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="cantidadIngreso"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Modo de pago</label>
                                <select
                                    v-model="form.modosPagos_id"
                                    name="modosPagos_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'modosPagos_id'
                                        )
                                    }"
                                >
                                    <option value
                                        >Seleccionar un modo de pago</option
                                    >
                                    <option
                                        v-for="(m, index) in modosPagos"
                                        :key="index"
                                        :value="m.id"
                                        >{{ m.modoPago }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="modosPagos_id"
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
            productos: [],
            modosPagos: [],
            ingresosProductos: {},
            search: "",
            form: new Form({
                id: "",
                cantidadIngreso: "",
                modosPagos_id: "",
                productos_id: "",
                precioCompra: ""
            })
        };
    },
    created() {
        this.loadProductos();
        this.loadModosPagos();
        this.loadIngresosProductos();
    },
    methods: {
        createIngresoProducto() {
            this.$Progress.start();
            this.form
                .post("ingresoProducto")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Ingreso de producto creado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadIngresosProductos();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        loadIngresosProductos() {
            axios
                .get("ingresoProducto")
                .then(res => {
                    this.ingresosProductos = res.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        },
        loadProductos() {
            axios.get("producto").then(res => (this.productos = res.data.data));
        },
        loadModosPagos() {
            axios
                .get("modoPago")
                .then(res => (this.modosPagos = res.data.data));
        },
        deleteIngresoProducto(id) {
            Swal.fire({
                title:
                    "¿Esta seguro que desea eliminar este ingreso de producto?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("ingresoProducto/" + id)
                        .then(() => {
                            this.loadIngresosProductos();
                            Swal.fire(
                                "Eliminado!",
                                "El ingreso de producto se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el ingreso",
                                "error"
                            );
                        });
                }
            });
        },
        newModal() {
            this.editMode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },

        editModal(ingresoProducto) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(ingresoProducto);
        },

        updateIngresoProducto() {
            this.$Progress.start();
            this.form
                .put("ingresoProducto/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Ingreso de producto actualizado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadIngresosProductos();
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
            let query = this.search;
            axios.get("ingresoProducto" + query + "?page=" + page).then(res => {
                this.ingresosProductos = res.data;
            });
        },

        buscar: _.debounce(function() {
            this.filter();
        }, 500),

        filter() {
            let query = this.search;
            axios.get("ingresoProducto/" + query).then(res => {
                this.ingresosProductos = res.data;
            });
        }
    }
};
</script>

<style lang="stylus" scoped></style>
