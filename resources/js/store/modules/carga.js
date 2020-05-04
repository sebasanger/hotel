import Axios from "axios";

export const namespaced = true;

export const state = {
    clientes: [],
    preciosHabitaciones: [],
    motivos: [],
    modosPagos: []
};

export const mutations = {
    SET_CLIENTES(state, clientes) {
        state.clientes = clientes;
    },
    SET_PRECIOSHABITACIONES(state, preciosHabitaciones) {
        state.preciosHabitaciones = preciosHabitaciones;
    },
    SET_MOTIVOS(state, motivos) {
        state.motivos = motivos;
    },
    SET_MODOSPAGOS(state, modosPagos) {
        state.modosPagos = modosPagos;
    }
};

export const actions = {
    fetchAllClientes({ commit }) {
        Axios.get("/getAllClientes").then(res => {
            commit("SET_CLIENTES", res.data);
        });
    },
    fetchAllPreciosHabitaciones({ commit }) {
        Axios.get("/getAllPreciosHabitaciones").then(res => {
            commit("SET_PRECIOSHABITACIONES", res.data);
        });
    },
    fetchAllMotivos({ commit }) {
        Axios.get("/getAllMotivos").then(res => {
            commit("SET_MOTIVOS", res.data);
        });
    },
    fetchAllModosPagos({ commit }) {
        Axios.get("/getAllModosPagos").then(res => {
            commit("SET_MODOSPAGOS", res.data);
        });
    }
};
