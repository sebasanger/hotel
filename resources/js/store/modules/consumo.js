import Axios from "axios";

export const namespaced = true;

export const state = {
    consumos: []
};

export const mutations = {
    SET_CONSUMOS(state, consumos) {
        state.consumos = consumos;
    }
};

export const actions = {
    fetchConsumosByReserva({ commit }, reservaId) {
        Axios.get("/getConsumosByReserva/" + reservaId)
            .then(res => {
                commit("SET_CONSUMOS", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los consumos de la reserva"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
