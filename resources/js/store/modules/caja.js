import Axios from "axios";

export const namespaced = true;

export const state = {
    cajas: {},
    caja: {},
    cajaShow: {},
    cajaActiva: {}
};

export const mutations = {
    SET_CAJAS(state, cajas) {
        state.cajas = cajas;
    },
    SET_CAJA(state, caja) {
        state.caja = caja;
    },
    SET_CAJASHOW(state, caja) {
        state.cajaShow = caja;
    },
    SET_CAJAACTIVA(state, caja) {
        state.cajaActiva = caja;
    }
};

export const actions = {
    fetchCajas({ commit, dispatch }, payload) {
        Axios.get("/caja/" + payload.query + "?page=" + payload.pagina)
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
    getCajaActiva({ commit, dispatch }) {
        Axios.get("/getCajaActiva")
            .then(res => {
                commit("SET_CAJAACTIVA", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No hay caja activa"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchCajaActiva({ commit, dispatch }) {
        Axios.get("/getCajaActiva/")
            .then(res => {
                commit("SET_CAJA", res.data);
                dispatch("pago/fetchPagosByCaja", res.data.id, { root: true });
                dispatch("movimiento/fetchIngresosByCaja", res.data.id, {
                    root: true
                });
                dispatch("movimiento/fetchEgresosByCaja", res.data.id, {
                    root: true
                });

                dispatch("consumo/fetchConsumosByCaja", res.data.id, {
                    root: true
                });
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "Error al cargar la caja activa"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchCajaShow({ commit, dispatch }, id) {
        Axios.get("/getCajaData/" + id)
            .then(res => {
                commit("SET_CAJASHOW", res.data);
                dispatch("pago/fetchPagosByCaja", res.data.id, { root: true });
                dispatch("movimiento/fetchIngresosByCaja", res.data.id, {
                    root: true
                });
                dispatch("movimiento/fetchEgresosByCaja", res.data.id, {
                    root: true
                });

                dispatch("consumo/fetchConsumosByCaja", res.data.id, {
                    root: true
                });
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "Error al cargar la caja"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
