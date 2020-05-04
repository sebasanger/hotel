import Axios from "axios";

export const namespaced = true;

export const state = {
    cajas: {},
    caja: {}
};

export const mutations = {
    SET_CAJAS(state, cajas) {
        state.cajas = cajas;
    },
    SET_CAJA(state, caja) {
        state.caja = caja;
    }
};

export const actions = {
    fetchCajas({ commit, dispatch }, payload) {
        Axios.get("caja/" + payload.query + "?page=" + payload.pagina)
            .then(res => {
                commit("SET_CAJAS", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar las cajas"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchCajaActiva({ commit, dispatch }) {
        Axios.get("/getCajaActiva/")
            .then(res => {
                commit("SET_CAJA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No hay caja activa"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
