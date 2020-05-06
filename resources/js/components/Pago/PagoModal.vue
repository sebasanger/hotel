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
                            v-text="'Agregar pago'"
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
                    <form @submit.prevent="createPago()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Monto del pago</label
                                >
                                <input
                                    v-model="formPago.monto"
                                    type="number"
                                    name="monto"
                                    required
                                    placeholder="Monto del pago"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formPago.errors.has(
                                            'monto'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="formPago"
                                    field="monto"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Modos de pago</label>
                                <select
                                    v-model="formPago.modosPagos_id"
                                    required
                                    name="modosPagos_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': formPago.errors.has(
                                            'modosPagos_id'
                                        )
                                    }"
                                >
                                    <option value disabled
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
                                    :form="formPago"
                                    field="modosPagos_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Faltante</label>
                                <input
                                    disabled
                                    type="number"
                                    name="faltante"
                                    class="form-control"
                                    :value="faltante"
                                />
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
    props: ["reserva", "formPago", "caja", "modosPagos"],
    computed: {
        faltante() {
            if (this.reserva.totalPagar) {
                return (
                    this.reserva.totalPagar -
                    this.reserva.pagado -
                    this.formPago.monto
                );
            } else {
                return "0";
            }
        }
    },
    methods: {
        createPago() {
            if (this.caja) {
                this.$Progress.start();
                this.formPago.reservas_id = this.reserva.id;
                this.formPago.cajas_id = this.caja.id;
                this.formPago
                    .post("/pago")
                    .then(res => {
                        this.$store.dispatch(
                            "fetchReserva",
                            res.data.reservas_id
                        );
                        this.$store.dispatch("fetchReservas");
                        $("#addPago").modal("hide");
                        Toast.fire({
                            icon: "success",
                            title: "Pago agregado correctamente"
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
            } else {
                Toast.fire({
                    icon: "error",
                    title: "Primero debe abrir una caja"
                });
            }
        }
    }
};
</script>
