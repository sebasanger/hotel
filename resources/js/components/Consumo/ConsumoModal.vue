<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addConsumo"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addConsumo"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addConsumo"
                            v-text="'Agregar consumo a la reserva'"
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
                    <form @submit.prevent="createConsumo()">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Producto</label>
                                    <select
                                        @change="getProduct($event)"
                                        v-model="formConsumo.productos_id"
                                        required
                                        name="productos_id"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': formConsumo.errors.has(
                                                'productos_id'
                                            )
                                        }"
                                    >
                                        <option value disabled
                                            >Seleccionar el producto</option
                                        >
                                        <option
                                            v-for="p in productos"
                                            :key="p.id"
                                            :value="p.id"
                                            >{{ p.producto }}</option
                                        >
                                    </select>
                                    <has-error
                                        :form="formConsumo"
                                        field="productos_id"
                                    ></has-error>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Cantidad</label>
                                    <input
                                        v-model="formConsumo.cantidad"
                                        :max="producto.stock"
                                        type="number"
                                        name="cantidad"
                                        class="form-control text-center"
                                        :class="{
                                            'is-invalid': formConsumo.errors.has(
                                                'cantidad'
                                            )
                                        }"
                                    />
                                    <has-error
                                        :form="formConsumo"
                                        field="cantidad"
                                    ></has-error>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Pagado</label>
                                    <select
                                        v-model="formConsumo.pagado"
                                        name="pagado"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': formConsumo.errors.has(
                                                'pagado'
                                            )
                                        }"
                                    >
                                        <option value="0">No</option>
                                        <option value="1">Si</option></select
                                    >
                                    <has-error
                                        :form="formConsumo"
                                        field="pagado"
                                    ></has-error>
                                </div>

                                <div
                                    class="form-group col-md-6"
                                    v-if="formConsumo.pagado == 1"
                                >
                                    <label>Modos de pago</label>
                                    <select
                                        v-model="formConsumo.modosPagos_id"
                                        required
                                        name="modosPagos_id"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': formConsumo.errors.has(
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
                                        :form="formConsumo"
                                        field="modosPagos_id"
                                    ></has-error>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Total</label>
                                    <input
                                        disabled
                                        type="number"
                                        name="total"
                                        class="form-control text-center"
                                        :value="
                                            formConsumo.cantidad *
                                                producto.precio
                                        "
                                    />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label class="col-form-label"
                                        >Stock actual del producto</label
                                    >
                                    <input
                                        disabled
                                        type="number"
                                        name="faltante"
                                        class="form-control text-center"
                                        :value="producto.stock"
                                    />
                                </div>

                                <div class="form-group col-md-7">
                                    <label class="col-form-label"
                                        >Marca del producto</label
                                    >
                                    <input
                                        disabled
                                        type="text"
                                        name="marca"
                                        class="form-control"
                                        :value="producto.marca"
                                    />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label class="col-form-label"
                                        >Codigo del producto</label
                                    >
                                    <input
                                        disabled
                                        type="text"
                                        name="codigoProducto"
                                        class="form-control"
                                        :value="producto.codigoProducto"
                                    />
                                </div>

                                <div class="form-group col-md-7">
                                    <label class="col-form-label"
                                        >Categoria del producto</label
                                    >
                                    <input
                                        disabled
                                        type="text"
                                        name="categoria"
                                        class="form-control"
                                        :value="producto.categoria"
                                    />
                                </div>
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
import { mapState } from "vuex";
export default {
    props: ["reserva", "formConsumo", "caja", "modosPagos", "productos"],
    computed: {
        ...mapState("producto", ["producto"])
    },
    methods: {
        createConsumo() {
            if (this.caja) {
                this.$Progress.start();
                this.formConsumo.reservas_id = this.reserva.id;
                this.formConsumo.cajas_id = this.caja.id;
                this.formConsumo
                    .post("/consumo")
                    .then(res => {
                        this.$store.dispatch(
                            "fetchReserva",
                            res.data.reservas_id
                        );
                        this.$store.dispatch("fetchReservas");
                        this.$store.dispatch("producto/fetchAllProductos");
                        $("#addConsumo").modal("hide");
                        Toast.fire({
                            icon: "success",
                            title: "Consumo agregado correctamente"
                        });
                        if (res.data.pagado == 1) {
                            Toast.fire({
                                icon: "success",
                                title: "Consumo y pago agregado a la reserva"
                            });
                        }
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
        },
        getProduct(event) {
            this.$store.dispatch("producto/fetchProducto", event.target.value);
        }
    }
};
</script>
