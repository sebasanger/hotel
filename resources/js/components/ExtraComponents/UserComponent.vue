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
                            Agregar usuario
                        </button>
                        <div
                            class="input-group input-group-sm"
                            style="width: 200px;"
                        >
                            <input
                                autocomplete="off"
                                type="text"
                                name="table_search"
                                class="form-control float-lg-left"
                                placeholder="Buscar por nombre o email"
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
                        <table
                            class="table table-bordered table-hover dataTable"
                        >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Telefono</th>
                                    <th>Celular</th>
                                    <th>Direccion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in users.data" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name | capitalize }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.role | roleText }}</td>
                                    <td>{{ item.telefono }}</td>
                                    <td>{{ item.celular }}</td>
                                    <td>{{ item.direccion | capitalize }}</td>
                                    <td class="text-center">
                                        <button
                                            @click="editModal(item)"
                                            class="btn "
                                        >
                                            <i class="fa fa-edit blue"></i>
                                        </button>

                                        <button
                                            class="btn ml-2"
                                            @click="deleteUser(item.id)"
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
                            :data="users"
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
                                editMode ? 'Editar usuario' : 'Crear usuario'
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
                        @submit.prevent="editMode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    required
                                    placeholder="Nombre"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    required
                                    placeholder="Email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>

                            <div class="form-group" v-if="editMode">
                                <label>Contraseña</label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>

                            <div class="form-group" v-if="!editMode">
                                <label>Contraseña</label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Rol</label>
                                <select
                                    v-model="form.role"
                                    name="role"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('role')
                                    }"
                                >
                                    <option value>Seleccionar un rol</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Usuario</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="role"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Celular</label>
                                <input
                                    v-model="form.celular"
                                    type="number"
                                    name="celular"
                                    placeholder="Celular"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('celular')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="celular"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Telefono</label>
                                <input
                                    v-model="form.telefono"
                                    type="number"
                                    name="telefono"
                                    placeholder="Telefono"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'telefono'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="telefono"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Direccion</label>
                                <input
                                    v-model="form.direccion"
                                    type="text"
                                    name="direccion"
                                    placeholder="Direccion"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'direccion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="direccion"
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
            users: {},
            search: "",
            form: new Form({
                id: "",
                name: "",
                email: "",
                password: "",
                role: "",
                celular: "",
                telefono: "",
                direccion: ""
            })
        };
    },
    created() {
        this.loadUsers();
        // Fire.$on("AfterCreate", () => {
        //   this.loadUsers();
        // });

        // setInterval(() => {
        //   this.loadUsers();
        // }, 5000);
    },
    methods: {
        createUser() {
            this.$Progress.start();
            this.form
                .post("user")
                .then(() => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Creado correctamente"
                    });
                    //Fire.$emit("AfterCreate");
                    this.$Progress.finish();
                    this.loadUsers();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        loadUsers() {
            axios
                .get("user")
                .then(res => {
                    this.users = res.data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        },
        deleteUser(id) {
            Swal.fire({
                title: "¿Esta seguro que desea eliminar este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("user/" + id)
                        .then(() => {
                            this.loadUsers();
                            Swal.fire(
                                "Eliminado!",
                                "El usuario se elimino correctamente.",
                                "success"
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error!",
                                "No se pudo eliminar el usuario",
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

        editModal(user) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(user);
        },

        updateUser() {
            this.$Progress.start();
            this.form
                .put("user/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Actualizado correctamente"
                    });
                    this.$Progress.finish();
                    this.loadUsers();
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
            axios.get("user/" + query + "?page=" + page).then(res => {
                this.users = res.data;
            });
        },
        //se busca cada cierto tiempo lo que ponemos en el filtro con la funcion debounce
        buscar: _.debounce(function() {
            this.filter();
        }, 500),

        //llama a la ruta find user
        filter() {
            let query = this.search;
            axios.get("user/" + query).then(res => {
                this.users = res.data;
            });
        }
    }
};
</script>

<style lang="stylus" scoped></style>
