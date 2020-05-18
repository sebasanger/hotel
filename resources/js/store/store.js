import Vue from "vue";
import Vuex from "vuex";
import Axios from "axios";
import * as user from "./modules/user.js";
import * as cliente from "./modules/cliente.js";
import * as habitacion from "./modules/habitacion.js";
import * as carga from "./modules/carga.js";
import * as caja from "./modules/caja.js";
import * as pago from "./modules/pago.js";
import * as consumo from "./modules/consumo.js";
import * as movimiento from "./modules/movimiento.js";
import * as producto from "./modules/producto.js";
import * as notification from "./modules/notification.js";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        notification,
        cliente,
        habitacion,
        carga,
        caja,
        pago,
        consumo,
        producto,
        movimiento
    },
    state: {
        reservas: [],
        reserva: {},
        elementos: []
    },
    mutations: {
        SET_RESERVAS(state, reservas) {
            state.reservas = reservas;
        },
        SET_RESERVA(state, reserva) {
            state.reserva = reserva;
        },
        SET_ELEMENTOS(state, elementos) {
            state.elementos = elementos;
        }
    },
    actions: {
        fetchReservas({ commit }) {
            var elementos = [];
            Axios.get("/reserva").then(res => {
                res.data.forEach(element => {
                    elementos.push({
                        id: element.id.toString(),
                        rowId: element.habitaciones_id.toString(),
                        label:
                            element.nombre +
                            " " +
                            element.apellido +
                            " " +
                            element.numeroHabitacion,
                        pagado: element.pagado,
                        huespedes: element.huespedes,
                        patenteAuto: element.patenteAuto,
                        nombre: element.nombre,
                        apellido: element.apellido,
                        numeroHabitacion: element.numeroHabitacion,
                        precio: element.precio,
                        totalPagar: element.totalPagar,
                        created_at: element.created_at,
                        style: {
                            background: element.color
                        },
                        time: {
                            start: new Date(element.ingreso).getTime(),
                            end: new Date(element.egreso).getTime()
                        }
                    });
                });
                commit("SET_RESERVAS", res.data);
                commit("SET_ELEMENTOS", elementos);
            });
        },
        fetchReserva({ commit, dispatch }, id) {
            Axios.get("/reserva/" + id)
                .then(res => {
                    dispatch("pago/fetchPagosByReserva", id);
                    dispatch("consumo/fetchConsumosByReserva", id);
                    dispatch("cliente/fetchCliente", res.data.clientes_id);
                    commit("SET_RESERVA", res.data);
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        }
    }
});
