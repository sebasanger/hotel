<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="cerrarCaja"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="cerrarCaja"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cerrarCaja">
                            Cerrar caja actual
                        </h5>
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
                                    >Monto de cierre</label
                                >
                                <input
                                    v-model="formCerrarCaja.montoCierre"
                                    type="number"
                                    name="montoCierre"
                                    required
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formCerrarCaja.errors.has(
                                            'montoCierre'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="formCerrarCaja"
                                    field="montoCierre"
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
    props: ["formCerrarCaja", "cajaActiva"],
    methods: {
        createCaja() {
            this.$Progress.start();
            this.formCerrarCaja
                .put("/caja/" + this.cajaActiva.id)
                .then(() => {
                    //router.push({ name: "home", params: { userId: 123 } });
                    this.$router.push({ name: "home" });
                    this.$store.dispatch("caja/fetchCajaActiva");
                    $("#cerrarCaja").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Se cerro la caja correctamente"
                    });
                    this.$Progress.finish();
                })

        }
    }
};
</script>
