<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button
                            class="btn-success float-right"
                            @click="newModal"
                        >
                            Agregar producto
                        </button>
                        <div
                            class="input-group input-group-sm"
                            style="width: 200px;"
                        >
                            <select
                                v-model="search"
                                name="categorias_id"
                                @change="buscar()"
                                class="form-control"
                            >
                                <option value>Filtrar por categoria</option>
                                <option
                                    v-for="(c, index) in categorias"
                                    :key="index"
                                    :value="c.id"
                                    >{{ c.categoria }}</option
                                >
                            </select>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Codigo</th>
                                    <th>Marca</th>
                                    <th>Categoria</th>
                                    <th>Agregado</th>
                                    <th>Modificado</th>
                                    <th>Nuevo ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in productos.data"
                                    :key="item.id"
                                >
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.producto | capitalize }}</td>
                                    <td>{{ item.precio }}</td>
                                    <td>{{ item.stock }}</td>
                                    <td>{{ item.codigoProducto }}</td>
                                    <td>{{ item.marca | capitalize }}</td>
                                    <td>{{ item.categoria | capitalize }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td>
                                        <button
                                            @click="ingresoModal(item.id)"
                                            class="btn"
                                        >
                                            <i class="fa fa-plus cyan"></i>
                                        </button>
                                    </td>
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
                                            @click="deleteProducto(item.id)"
                                        >
                                            <i class="fa fa-trash red"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" v-show="!search">
                        <pagination
                            :data="productos"
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
                                editMode ? 'Editar producto' : 'Crear producto'
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
                            editMode ? updateProducto() : createProducto()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre del producto</label>
                                <input
                                    v-model="form.producto"
                                    type="text"
                                    name="producto"
                                    required
                                    placeholder="producto"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'producto'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="producto"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Precio</label>
                                <input
                                    v-model="form.precio"
                                    type="number"
                                    name="precio"
                                    required
                                    placeholder="precio"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('precio')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="precio"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Stock actual</label>
                                <input
                                    v-model="form.stock"
                                    type="number"
                                    name="stock"
                                    placeholder="stock"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('stock')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="stock"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Codigo del producto</label>
                                <input
                                    v-model="form.codigoProducto"
                                    type="text"
                                    name="codigoProducto"
                                    placeholder="Codigo"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'codigoProducto'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="codigoProducto"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Marca del producto</label>
                                <select
                                    v-model="form.marcas_id"
                                    name="marcas_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'marcas_id'
                                        )
                                    }"
                                >
                                    <option value>Seleccionar una marca</option>
                                    <option
                                        v-for="(m, index) in marcas"
                                        :key="index"
                                        :value="m.id"
                                        >{{ m.marca }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="marcas_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Categoria del producto</label>
                                <select
                                    v-model="form.categorias_id"
                                    name="categorias_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'categorias_id'
                                        )
                                    }"
                                >
                                    <option value
                                        >Seleccionar una categoria</option
                                    >
                                    <option
                                        v-for="(c, index) in categorias"
                                        :key="index"
                                        :value="c.id"
                                        >{{ c.categoria }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="categorias_id"
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

        <!-- Modal de ingreso de producto-->
        <div
            class="modal fade"
            id="addNewIngreso"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNewIngreso"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addNewIngreso"
                            v-text="
                                'Nuevo ingreso de producto id: ' +
                                    formIngreso.productos_id
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
                    <form @submit.prevent="createIngresoProducto()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Precio de compra</label>
                                <input
                                    v-model="formIngreso.precioCompra"
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
                                    v-model="formIngreso.cantidadIngreso"
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
                                    v-model="formIngreso.modosPagos_id"
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
            productos: {},
            search: "",
            categorias: {},
            modosPagos: {},
            marcas: {},
            form: new Form({
                id: "",
                producto: "",
                marcas_id: "",
                categorias_id: "",
                codigoProducto: "",
                stock: "",
                precio: ""
            }),
            formIngreso: new Form({
                productos_id: "",
                modosPagos_id: "",
                cantidad: "",
                precioCompra: ""
            })
        };
    },
    created() {
        this.loadProductos();
        this.loadMarcas();
        this.loadCategorias();
        this.loadModosPagos();
    },
    methods: {
        createProducto() {
            this.$Progress.start();
            this.form
                .post("producto")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Producto creado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadProductos();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        loadProductos() {
            axios
                .get("producto")
                .then(res => {
                    this.productos = res.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        },
        loadCategorias() {
            axios
                .get("categoria")
                .then(res => (this.categorias = res.data.data));
        },
        loadMarcas() {
            axios.get("marca").then(res => (this.marcas = res.data.data));
        },
        deleteProducto(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este producto?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("producto/" + id)
                        .then(() => {
                            this.loadProductos();
                            Swal.fire(
                                "Eliminado!",
                                "El producto se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el producto",
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

        editModal(producto) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(producto);
        },

        updateProducto() {
            this.$Progress.start();
            this.form
                .put("producto/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Producto actualizado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadProductos();
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
            axios.get("producto/" + query + "?page=" + page).then(res => {
                this.productos = res.data;
            });
        },

        buscar: _.debounce(function() {
            this.filter();
        }, 50),

        filter() {
            let query = this.search;
            axios.get("producto/" + query).then(res => {
                this.productos = res.data;
            });
        },

        //parte de ingreso de producto
        loadModosPagos() {
            axios
                .get("modoPago")
                .then(res => (this.modosPagos = res.data.data));
        },

        ingresoModal(id) {
            this.formIngreso.reset();
            $("#addNewIngreso").modal("show");
            this.formIngreso.productos_id = id;
        },
        createIngresoProducto() {
            this.$Progress.start();
            this.formIngreso
                .post("ingresoProducto")
                .then(() => {
                    $("#addNewIngreso").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Ingreso de producto agregado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadProductos();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        }
    }
};
</script>

<style lang="stylus" scoped></style>
