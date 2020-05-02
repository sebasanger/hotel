<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addPago"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addPago"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addPago"
                            v-text="editPago ? 'Editar pago' : 'Agregar pago'"
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
                        @submit.prevent="editPago ? updatepago() : createPago()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Monto del pago</label
                                >
                                <input
                                    v-model="pagoForm.monto"
                                    type="number"
                                    name="monto"
                                    required
                                    placeholder="Monto del pago"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': pagoForm.errors.has(
                                            'nombre'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="pagoForm"
                                    field="monto"
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
                                v-if="!editPago"
                                type="submit"
                                class="btn btn-success"
                            >
                                Guardar
                            </button>
                            <button
                                v-if="editPago"
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
    props: ["editPago", "reserva", "pagoForm"],

    methods: {
        updatePago() {
            this.$Progress.start();
            this.form
                .put("cliente/" + this.form.id)
                .then(res => {
                    //actualiza los clientes manteniendo la pagina y filtros actuales
                    this.getResults(this.paginaActual, this.search);
                    $("#addPago").modal("hide");
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

        createPago() {
            this.$Progress.start();
            this.form
                .post("cliente")
                .then(() => {
                    //se limpia posibles filtros para que devuelva a la pagina 1 y se vea la agregacion del usuario
                    this.search = "";
                    //carga los clientes nuevamente pero nos devuelve a la pagina 1
                    this.getResults(1, "");
                    //se cierra el modal
                    $("#addPago").modal("hide");
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
