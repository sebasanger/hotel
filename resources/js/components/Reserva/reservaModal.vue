<template>
    <div>
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
                                editMode ? 'Editar reserva' : 'Crear reserva'
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
                            editMode ? UpdateReserva() : createReserva()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>*Cantidad de huespedes</label>
                                <select
                                    required
                                    v-model="form.huespedes"
                                    name="huespedes"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'huespedes'
                                        )
                                    }"
                                >
                                    <option disabled selected value
                                        >Seleccionar la cantidad de
                                        huespedes</option
                                    >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="clientes_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>*Huesped</label>
                                <select
                                    required
                                    v-model="form.clientes_id"
                                    name="clientes_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'clientes_id'
                                        )
                                    }"
                                >
                                    <option disabled selected value>
                                        Seleccionar el huesped
                                    </option>
                                    <option
                                        v-for="c in clientes"
                                        :key="c.id"
                                        :value="c.id"
                                        >{{
                                            c.nombre + " " + c.apellido
                                        }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="clientes_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>*Habitacion</label>
                                <select
                                    required
                                    v-model="form.habitaciones_id"
                                    name="habitaciones_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'habitaciones_id'
                                        )
                                    }"
                                >
                                    <option
                                        v-for="h in habitaciones"
                                        :key="h.id"
                                        :value="h.id"
                                        >{{ h.numeroHabitacion }}</option
                                    >
                                    <option disabled selected value>
                                        Seleccionar la habitacion
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="habitaciones_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>*Ingreso/Egreso</label>
                                <HotelDatePicker
                                    :minNights="1"
                                    name="ingreso"
                                    format="DD/MM/YYYY"
                                    :i18n="ptAr"
                                    @check-in-changed="ingresoChanged($event)"
                                    @check-out-changed="egresoChanged($event)"
                                >
                                </HotelDatePicker>
                                <has-error
                                    :form="form"
                                    field="ingreso"
                                ></has-error>
                                <has-error
                                    :form="form"
                                    field="egreso"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>*Precio</label>
                                <select
                                    required
                                    v-model="form.preciosHabitaciones_id"
                                    name="preciosHabitaciones_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'preciosHabitaciones_id'
                                        )
                                    }"
                                >
                                    <option disabled selected value>
                                        Seleccionar el precio
                                    </option>
                                    <option
                                        v-for="ph in preciosHabitaciones"
                                        :key="ph.id"
                                        :value="ph.id"
                                        >{{
                                            ph.precioHabitacion +
                                                " " +
                                                ph.descripcion
                                        }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="preciosHabitaciones_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Pagado</label>
                                <input
                                    v-model.number="form.pagado"
                                    type="number"
                                    name="pagado"
                                    placeholder="Cantidad que pago el huesped"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('pagado')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="pagado"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Motivo</label>
                                <select
                                    v-model="form.motivos_id"
                                    name="motivos_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'motivos_id'
                                        )
                                    }"
                                >
                                    <option disabled selected value>
                                        Seleccionar el motivo del viaje
                                    </option>
                                    <option
                                        v-for="m in motivos"
                                        :key="m.id"
                                        :value="m.id"
                                        >{{ m.motivo }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="motivos_id"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Destino</label>
                                <input
                                    v-model="form.destino"
                                    type="text"
                                    name="destino"
                                    placeholder="A donde se dirije el huesped"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('destino')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="destino"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Procedencia</label>
                                <input
                                    v-model="form.procedencia"
                                    type="text"
                                    name="procedencia"
                                    placeholder="De donde viene el huesped"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'procedencia'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="procedencia"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Patente</label>
                                <input
                                    v-model="form.patenteAuto"
                                    type="text"
                                    name="patenteAuto"
                                    placeholder="Patente del vehiculo"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'patenteAuto'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="patenteAuto"
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
import HotelDatePicker from "vue-hotel-datepicker";
import moment from "moment";
export default {
    components: {
        HotelDatePicker
    },
    props: [
        "index",
        "item",
        "form",
        "editMode",
        "habitaciones",
        "clientes",
        "motivos",
        "preciosHabitaciones"
    ],
    data() {
        return {
            ptAr: {
                night: "Noche",
                nights: "Noches",
                "day-names": ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                "check-in": "Ingreso",
                "check-out": "Egreso",
                "month-names": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ]
            }
        };
    },

    methods: {
        ingresoChanged(newDate) {
            let newIngreso = moment(newDate).format("YYYY/MM/DD");
            this.form.ingreso = newIngreso;
        },
        egresoChanged(newDate) {
            let newEgreso = moment(newDate).format("YYYY/MM/DD");
            this.form.egreso = newEgreso;
        },
        updateReserva() {
            this.$Progress.start();
            this.form
                .put("cliente/" + this.form.id)
                .then(res => {
                    $("#addNew").modal("hide");
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

        createReserva() {
            this.$Progress.start();
            this.form
                .post("reserva")
                .then(() => {
                    this.$store.dispatch("fetchReservas");
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Reserva creada correctamente"
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
