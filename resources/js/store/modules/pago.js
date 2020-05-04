import Axios from "axios";

export const namespaced = true;

export const state = {
    pagos: [],
    pago: {}
};

export const mutations = {
    SET_PAGOS(state, pagos) {
        state.pagos = pagos;
    },
    SET_PAGO(state, pago) {
        state.pago = pago;
    }
};

export const actions = {
    fetchPagosByReserva({ commit }, reservaId) {
        Axios.get("/getPagosByReserva/" + reservaId)
            .then(res => {
                commit("SET_PAGOS", res.data);
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
