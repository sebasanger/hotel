<template>
    <div>
        <p>
            nombre:
            {{ (reserva.nombre + " " + reserva.apellido) | capitalize }}
        </p>

        <p>numero de la habitacion: {{ reserva.numeroHabitacion }}</p>

        <p>Precio por dia: {{ reserva.precio }}</p>

        <p>Total a pagar: {{ reserva.totalPagar }}</p>

        <p>Total pagado: {{ reserva.pagado }}</p>

        <p>Falta pagar: {{ reserva.totalPagar - reserva.pagado }}</p>

        <p>Ingreso: {{ reserva.ingreso | formatDate }}</p>

        <p>Egreso: {{ reserva.egreso | formatDate }}</p>

        <p>Dias totales: {{ betWeen }}</p>

        <p v-if="reserva.patenteAuto">
            Patente del auto: {{ reserva.patenteAuto }}
        </p>

        <p v-if="reserva.procedencia">
            Procedencia del cliente: {{ reserva.procedencia | capitalize }}
        </p>

        <p v-if="reserva.destino">
            Destino del huesped: {{ reserva.destino | capitalize }}
        </p>

        <button @click="editModal(reserva)" class="btn">
            <i class="fa fa-edit blue"></i>
        </button>

        <router-link :to="{ name: 'reserva' }">atras</router-link>

        <reserva-modal
            :form="form"
            :habitaciones="habitaciones"
            :clientes="clientes"
            :preciosHabitaciones="preciosHabitaciones"
            :motivos="motivos"
            :editMode="editMode"
        />
    </div>
</template>

<script>
import { mapState } from "vuex";
import moment from "moment";
import ReservaModal from "./reservaModal.vue";

export default {
    components: {
        ReservaModal
    },
    props: ["id"],
    data() {
        return {
            editMode: "false",
            form: new Form({
                id: "",
                clientes_id: "",
                preciosHabitaciones_id: "",
                motivos_id: "",
                habitaciones_id: "",
                ingreso: "",
                egreso: "",
                pagado: "",
                huespedes: "",
                patenteAuto: "",
                destino: "",
                procedencia: ""
            })
        };
    },
    created() {
        this.$store
            .dispatch("fetchReserva", this.id)
            .then(() => {
                this.$Progress.finish();
            })
            .catch(() => {
                this.$router.push({
                    name: "500"
                });
            });
    },
    computed: {
        ...mapState(["reserva"]),
        ...mapState("habitacion", ["habitaciones"]),
        ...mapState("carga", ["motivos", "clientes", "preciosHabitaciones"]),
        betWeen() {
            var a = moment(this.reserva.egreso);
            var b = moment(this.reserva.ingreso);
            return a.diff(b, "days");
            //return moment().diff();
        }
    },
    methods: {
        editModal(reserva) {
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(reserva);
        }
    }
};
</script>
