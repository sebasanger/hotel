import Vue from "vue";
import Vuex from "vuex";
import Axios from "axios";
import * as user from "./modules/user.js";
import * as cliente from "./modules/cliente.js";
import * as notification from "./modules/notification.js";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        notification,
        cliente
    },
    state: {
        reservas: [],
        reserva: {},
        elementos: [],
        habitaciones: []
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
        },
        SET_HABITACIONES(state, habitaciones) {
            state.habitaciones = habitaciones;
        }
    },
    actions: {
        fetchReservas({ commit }) {
            var elementos = [];
            Axios.get("/reserva").then(res => {
                commit("SET_RESERVAS", res.data);
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
                commit("SET_ELEMENTOS", elementos);
            });
        },
        fetchReserva({ commit, getters }, id) {
            var reserva = getters.getReservaById(id);
            if (reserva) {
                commit("SET_RESERVA", reserva);
            } else {
                Axios.get("/reserva/" + id).then(res => {
                    commit("SET_RESERVA", res.data);
                });
            }
        },
        fetchHabitaciones({ commit }) {
            Axios.get("/habitacion").then(res => {
                commit("SET_HABITACIONES", res.data.data);
            });
        }
    },
    getters: {
        getReservaById: state => id => {
            return state.reservas.find(reserva => reserva.id == id);
        }
    }
});
