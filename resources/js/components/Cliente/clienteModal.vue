<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addEditCliente"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addEditCliente"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title text-center"
                            id="addEditCliente"
                            v-text="
                                editMode ? 'Editar cliente' : 'Crear cliente'
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
                            editMode ? updateCliente() : createCliente()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre</label>
                                <input
                                    v-model="form.nombre"
                                    type="text"
                                    name="nombre"
                                    required
                                    placeholder="Nombre"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('nombre')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="nombre"
                                ></has-error>
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
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'apellido'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="apellido"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>DNI</label>
                                <input
                                    v-model="form.dni"
                                    type="number"
                                    name="dni"
                                    placeholder="dni"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('dni')
                                    }"
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
                                <label>Domicilio</label>
                                <input
                                    v-model="form.domicilio"
                                    type="text"
                                    name="domicilio"
                                    placeholder="Domicilio"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'domicilio'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="domicilio"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Profecion</label>
                                <input
                                    v-model="form.profecion"
                                    type="text"
                                    name="profecion"
                                    placeholder="Profecion"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'profecion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="profecion"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Factura</label>
                                <select
                                    v-model="form.facturas_id"
                                    name="facturas_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'facturas_id'
                                        )
                                    }"
                                >
                                    <option value selected disabled
                                        >Seleccionar una factura</option
                                    >
                                    <option
                                        v-for="f in facturas"
                                        :key="f.id"
                                        :value="f.id"
                                        >{{ f.tipoFactura }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="facturas_id"
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
    props: ["item", "search", "paginaActual", "form", "editMode", "facturas"],
    methods: {
        updateCliente() {
            this.$Progress.start();
            this.form
                .put("/cliente/" + this.form.id)
                .then(res => {
                    //actualiza los clientes manteniendo la pagina y filtros actuales
                    this.$store.dispatch("cliente/findCliente", res.id);
                    this.getResults(this.paginaActual, this.search);
                    this.$store.dispatch("carga/fetchAllClientes");
                    $("#addEditCliente").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Cliente actualizado correctamente"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Toast.fire({
                        icon: "error",
                        title: "Error"
                    });
                });
        },
        getResults(pagina, filtro) {
            let payload = { query: filtro, pagina: pagina };
            this.$store.dispatch("cliente/fetchClientes", payload);
        },
        createCliente() {
            this.$Progress.start();
            this.form
                .post("/cliente")
                .then(() => {
                    //se limpia posibles filtros para que devuelva a la pagina 1 y se vea la agregacion del usuario
                    this.search = "";
                    //carga los clientes nuevamente pero nos devuelve a la pagina 1
                    this.getResults(1, "");
                    //se recarga los clientes
                    this.$store.dispatch("carga/fetchAllClientes");
                    //se cierra el modal
                    $("#addEditCliente").modal("hide");
                    //se da el aviso de que fue todo correcto
                    Toast.fire({
                        icon: "success",
                        title: "Cliente creado correctamente"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {
                    //sino se avisa de un error pero se mantiene el modal hasta que se haga correctamente
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
