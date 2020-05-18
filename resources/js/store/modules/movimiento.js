import Axios from "axios";

export const namespaced = true;

export const state = {
    ingresosCaja: [],
    egresosCaja: []
};

export const mutations = {
    SET_INGRESOSCAJA(state, movimientos) {
        state.ingresosCaja = movimientos;
    },
    SET_EGRESOSCAJA(state, movimientos) {
        state.egresosCaja = movimientos;
    }
};

export const actions = {
    fetchIngresosByCaja({ commit }, cajaId) {
        Axios.get("/getIngresos/" + cajaId)
            .then(res => {
                commit("SET_INGRESOSCAJA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los ingrsos de la caja"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchEgresosByCaja({ commit }, cajaId) {
        Axios.get("/getEgresos/" + cajaId)
            .then(res => {
                commit("SET_EGRESOSCAJA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los egresos de la caja"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
