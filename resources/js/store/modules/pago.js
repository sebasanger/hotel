import Axios from "axios";

export const namespaced = true;

export const state = {
    pagosReservas: [],
    pagosCajas: [],
    pago: {}
};

export const mutations = {
    SET_PAGOSRESERVAS(state, pagos) {
        state.pagosReservas = pagos;
    },
    SET_PAGOSCAJAS(state, pagos) {
        state.pagosCajas = pagos;
    },
    SET_PAGO(state, pago) {
        state.pago = pago;
    }
};

export const actions = {
    fetchPagosByReserva({ commit }, reservaId) {
        Axios.get("/getPagosByReserva/" + reservaId)
            .then(res => {
                commit("SET_PAGOSRESERVAS", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los pagos de la reserva"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchPagosByCaja({ commit }, cajaId) {
        Axios.get("/getPagosByCaja/" + cajaId)
            .then(res => {
                commit("SET_PAGOSCAJAS", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los pagos de la reserva"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
