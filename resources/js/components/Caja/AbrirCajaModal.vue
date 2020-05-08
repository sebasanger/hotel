<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="abrirCaja"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="abrirCaja"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="abrirCaja">Abrir caja</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="false">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createCaja()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Monto de apertura</label
                                >
                                <input
                                    v-model="formCaja.montoApertura"
                                    type="number"
                                    name="montoApertura"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formCaja.errors.has(
                                            'montoApertura'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="formCaja"
                                    field="montoApertura"
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
    props: ["formCaja"],
    methods: {
        createCaja() {
            this.$Progress.start();
            this.formCaja
                .post("/caja")
                .then(() => {
                    this.$store.dispatch("caja/fetchCajaActiva");
                    $("#abrirCaja").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Se abrio la caja correctamente"
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
