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
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content ">
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
                            editMode ? updateReserva() : createReserva()
                        "
                    >
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
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

                                    <div class="form-group col-md-6">
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
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
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
                                            <option disabled selected value>
                                                Seleccionar la habitacion
                                            </option>
                                            <option
                                                v-for="h in habitaciones"
                                                :key="h.id"
                                                :value="h.id"
                                                >{{
                                                    h.numeroHabitacion
                                                }}</option
                                            >
                                        </select>
                                        <has-error
                                            :form="form"
                                            field="habitaciones_id"
                                        ></has-error>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>*Precio</label>
                                        <select
                                            required
                                            v-model="
                                                form.preciosHabitaciones_id
                                            "
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
                                </div>

                                <div class="form-row" v-if="editMode">
                                    <div class="form-group col-md-12">
                                        <label>*Ingreso/Egreso</label>
                                        <HotelDatePicker
                                            v-if="
                                                reserva.ingreso &&
                                                    reserva.egreso
                                            "
                                            :minNights="1"
                                            name="ingreso"
                                            format="DD/MM/YYYY"
                                            :i18n="ptAr"
                                            @check-in-changed="
                                                ingresoChanged($event)
                                            "
                                            @check-out-changed="
                                                egresoChanged($event)
                                            "
                                            :startingDateValue="
                                                new Date(startIngreso)
                                            "
                                            :endingDateValue="
                                                new Date(startEgreso)
                                            "
                                            :startDate="
                                                new Date(
                                                    new Date().getFullYear(),
                                                    new Date().getMonth() - 1,
                                                    1
                                                )
                                            "
                                        >
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
                                </div>

                                <div class="form-row" v-else-if="!editMode">
                                    <div class="form-group col-md-12">
                                        <label>*Ingreso/Egreso</label>
                                        <HotelDatePicker
                                            :minNights="1"
                                            name="ingreso"
                                            format="DD/MM/YYYY"
                                            :i18n="ptAr"
                                            @check-in-changed="
                                                ingresoChanged($event)
                                            "
                                            @check-out-changed="
                                                egresoChanged($event)
                                            "
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
                                </div>

                                <div class="form-row" v-if="editMode">
                                    <div class="form-group col-md-4">
                                        <label>Total a pagar</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            disabled
                                            :value="total ? total : totalEdit"
                                        />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Pagado</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            disabled
                                            :value="
                                                reserva.pagado
                                                    ? reserva.pagado
                                                    : '0'
                                            "
                                        />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Faltante</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            disabled
                                            :value="
                                                total
                                                    ? total - reserva.pagado
                                                    : totalEdit - reserva.pagado
                                            "
                                        />
                                    </div>
                                </div>

                                <div class="form-row" v-if="!editMode">
                                    <div
                                        class="form-group col-md-3"
                                        v-if="caja.cajaActiva == 1"
                                    >
                                        <label>Pagado</label>
                                        <input
                                            v-model.number="form.pagado"
                                            type="number"
                                            name="pagado"
                                            placeholder="Dinero pagado"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'pagado'
                                                )
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="pagado"
                                        ></has-error>
                                    </div>

                                    <div
                                        class="form-group col-md-5"
                                        v-if="form.pagado >= 1"
                                    >
                                        <label>Modo de pago</label>
                                        <select
                                            required
                                            v-model="form.modosPagos_id"
                                            name="modosPagos_id"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'modosPagos_id'
                                                )
                                            }"
                                        >
                                            <option disabled selected value>
                                                Seleccionar el modo de pago
                                            </option>
                                            <option
                                                v-for="mp in modosPagos"
                                                :key="mp.id"
                                                :value="mp.id"
                                                >{{ mp.modoPago }}</option
                                            >
                                        </select>
                                        <has-error
                                            :form="form"
                                            field="modosPagos_id"
                                        ></has-error>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Total a pagar</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            disabled
                                            :value="total ? total : ''"
                                        />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Faltante</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            disabled
                                            :value="
                                                total ? total - form.pagado : ''
                                            "
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
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

                                    <div class="form-group col-md-6">
                                        <label>Destino</label>
                                        <input
                                            v-model="form.destino"
                                            type="text"
                                            name="destino"
                                            placeholder="A donde se dirije el huesped"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'destino'
                                                )
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="destino"
                                        ></has-error>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
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

                                    <div class="form-group col-md-6">
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
import { mapState } from "vuex";
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
        "preciosHabitaciones",
        "modosPagos",
        "caja"
    ],
    data() {
        return {
            precioDia: 0,
            ingreso: "",
            egreso: "",
            ingresoInicial: "",
            egresoInicial: "",
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
            this.ingreso = newDate;
            let newIngreso = moment(newDate).format("YYYY/MM/DD");
            this.form.ingreso = newIngreso;
        },
        egresoChanged(newDate) {
            this.egreso = newDate;
            let newEgreso = moment(newDate).format("YYYY/MM/DD");
            this.form.egreso = newEgreso;
        },
        updateReserva() {
            this.$Progress.start();
            this.form
                .put("/reserva/" + this.form.id)
                .then(res => {
                    this.$store.dispatch("fetchReserva", res.data.id);
                    this.$store.dispatch("fetchReservas");
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Reserva actualizada correctamente"
                    });
                    this.$Progress.finish();
                })
                .catch(error => {
                    if (error.response.status == 400) {
                        Toast.fire({
                            icon: "error",
                            title: error.response.data.message
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "Error"
                        });
                    }
                    this.$Progress.fail();
                });
        },

        createReserva() {
            this.$Progress.start();
            this.form
                .post("/reserva")
                .then(() => {
                    this.$store.dispatch("fetchReservas");
                    $("#addNew").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Reserva creada correctamente"
                    });
                    this.$Progress.finish();
                })
                .catch(error => {
                    if (error.response.status == 400) {
                        Toast.fire({
                            icon: "error",
                            title: error.response.data.message
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "Error"
                        });
                    }
                    this.$Progress.fail();
                });
        }
    },
    computed: {
        ...mapState(["reserva"]),
        //para saber cuanto sale la reserva
        total() {
            //se averigua que este el egreso, ingreso y precio total
            if (
                this.ingreso &&
                this.egreso &&
                this.form.preciosHabitaciones_id
            ) {
                //se saca la diferencia entre el ingreso y egreso
                var a = moment(this.egreso);
                var b = moment(this.ingreso);
                let cantidadDias = a.diff(b, "days");
                //se busca el id del select de precio de habitacion
                let idPrecio = this.form.preciosHabitaciones_id;
                //se busca el precio por el id que buscamos antes
                this.precioDia = this.preciosHabitaciones.find(
                    precioHabitacion => precioHabitacion.id == idPrecio
                );
                //se retorna la multiplicacion de la cantidad de dias por el precio
                return this.precioDia.precioHabitacion * cantidadDias;
            }
        },
        //sirve para buscar dentro de la reserva en el modo de edicion, si se edita se busca el total de l formulario en el metodo this.total
        totalEdit() {
            //se averigua que este el egreso, ingreso y precio total pero en la reserva que se busco para editar
            if (
                this.reserva.ingreso &&
                this.reserva.egreso &&
                this.form.preciosHabitaciones_id
            ) {
                //se saca la diferencia entre el ingreso y egreso
                var a = moment(this.reserva.egreso);
                var b = moment(this.reserva.ingreso);
                let cantidadDias = a.diff(b, "days");
                //se busca el id del select de precio de habitacion
                let idPrecio = this.form.preciosHabitaciones_id;
                //se busca el precio por el id que buscamos antes
                this.precioDia = this.preciosHabitaciones.find(
                    precioHabitacion => precioHabitacion.id == idPrecio
                );
                //se retorna la multiplicacion de la cantidad de dias por el precio
                return this.precioDia.precioHabitacion * cantidadDias;
            }
        },
        startIngreso() {
            if (this.editMode && this.reserva.ingreso) {
                return moment(this.reserva.ingreso).format("YYYY,MM,DD");
            }
        },
        startEgreso() {
            if (this.editMode && this.reserva.egreso) {
                return moment(this.reserva.egreso).format("YYYY,MM,DD");
            }
        }
    }
};
</script>
