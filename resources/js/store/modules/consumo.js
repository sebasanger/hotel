import Axios from "axios";

export const namespaced = true;

export const state = {
    consumosCaja: [],
    consumosReserva: []
};

export const mutations = {
    SET_CONSUMOSCAJA(state, consumos) {
        state.consumosCaja = consumos;
    },
    SET_CONSUMOSRESERVA(state, consumos) {
        state.consumosReserva = consumos;
    }
};

export const actions = {
    fetchConsumosByReserva({ commit }, reservaId) {
        Axios.get("/getConsumosByReserva/" + reservaId)
            .then(res => {
                commit("SET_CONSUMOSRESERVA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los consumos de la reserva"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchConsumosByCaja({ commit }, cajaId) {
        Axios.get("/getConsumosByCaja/" + cajaId)
            .then(res => {
                commit("SET_CONSUMOSCAJA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los consumos de la caja"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
