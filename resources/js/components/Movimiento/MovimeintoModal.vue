<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addMovimiento"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addMovimiento"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addMovimiento"
                            v-text="
                                ingreso ? 'Agregar ingreso' : 'Agregar egreso'
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
                            ingreso ? createIngreso() : createEgreso()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Monto</label>
                                <input
                                    v-model="formMovimiento.monto"
                                    type="number"
                                    name="monto"
                                    placeholder="Monto del movimiento"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formMovimiento.errors.has(
                                            'dni'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="formMovimiento"
                                    field="dni"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label"
                                    >Descripcion</label
                                >
                                <input
                                    v-model="formMovimiento.descripcion"
                                    type="text"
                                    name="descripcion"
                                    required
                                    placeholder="Descripcion del movimiento"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formMovimiento.errors.has(
                                            'descripcion'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="formMovimiento"
                                    field="descripcion"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Modo de pago</label>
                                <select
                                    v-model="formMovimiento.modosPagos_id"
                                    name="modosPagos_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formMovimiento.errors.has(
                                            'modosPagos_id'
                                        )
                                    }"
                                >
                                    <option value
                                        >Seleccionar el modo de pago</option
                                    >
                                    <option
                                        v-for="mp in modosPagos"
                                        :key="mp.id"
                                        :value="mp.id"
                                        >{{ mp.modoPago }}</option
                                    >
                                </select>
                                <has-error
                                    :form="formMovimiento"
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
                            <button type="submit" class="btn btn-success">
                                Guardar
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
    props: ["formMovimiento", "ingreso", "modosPagos", "cajaActiva"],
    methods: {
        createEgreso() {
            this.$Progress.start();
            this.formMovimiento.tipo = 0;
            this.formMovimiento.cajas_id = this.cajaActiva.id;
            this.formMovimiento
                .post("/movimiento")
                .then(() => {
                    this.$store.dispatch("caja/fetchCajaActiva");
                    $("#addMovimiento").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Egreso de creado correctamente"
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
        createIngreso() {
            this.$Progress.start();
            this.formMovimiento.tipo = 1;
            this.formMovimiento.cajas_id = this.cajaActiva.id;
            this.formMovimiento
                .post("/movimiento")
                .then(() => {
                    this.$store.dispatch("caja/fetchCajaActiva");
                    $("#addMovimiento").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Ingreso creado correctamente"
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
        }
    }
};
</script>
