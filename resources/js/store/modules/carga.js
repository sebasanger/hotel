import Axios from "axios";

export const namespaced = true;

export const state = {
    clientes: [],
    preciosHabitaciones: [],
    motivos: []
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
    }
};

export const actions = {
    fetchClientes({ commit }) {
        Axios.get("/getAllClientes").then(res => {
            commit("SET_CLIENTES", res.data);
        });
    },
    fetchPreciosHabitaciones({ commit }) {
        Axios.get("/getAllPreciosHabitaciones").then(res => {
            commit("SET_PRECIOSHABITACIONES", res.data);
        });
    },
    fetchMotivos({ commit }) {
        Axios.get("/getAllMotivos").then(res => {
            commit("SET_MOTIVOS", res.data);
        });
    }
};
