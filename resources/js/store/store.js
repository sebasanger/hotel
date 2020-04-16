import Vue from "vue";
import Vuex from "vuex";
import Axios from "axios";
import * as user from "./modules/user.js";
import * as notification from "./modules/notification.js";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        notification
    },
    state: {
        reservas: [],
        reserva: {}
    },
    mutations: {
        SET_RESERVAS(state, reservas) {
            state.reservas = reservas;
        },
        SET_RESERVA(state, reserva) {
            state.reserva = reserva;
        }
    },
    actions: {
        fetchReservas({ commit }) {
            Axios.get("/reserva")
                .then(res => {
                    commit("SET_RESERVAS", res.data);
                })
                .catch(error => {
                    console.log("no se pudo cargar las reservas");
                });
        },
        fetchReserva({ commit, getters }, id) {
            var reserva = getters.getReservaById(id);
            if (reserva) {
                commit("SET_RESERVA", reserva);
            } else {
                Axios.get("/reserva/" + id)
                    .then(res => {
                        commit("SET_RESERVA", res.data);
                    })
                    .catch(err => {
                        console.log("error al cargar la reserva");
                    });
            }
        }
    },
    getters: {
        getReservaById: state => id => {
            return state.reservas.find(reserva => reserva.id === id);
        }
    }
});
