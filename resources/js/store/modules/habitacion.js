import Axios from "axios";

export const namespaced = true;

export const state = {
    habitaciones: [],
    habitacion: {}
};

export const mutations = {
    SET_HABITACIONES(state, habitaciones) {
        state.habitaciones = habitaciones;
    },
    SET_HABITACION(state, habitacion) {
        state.habitacion = habitacion;
    }
};

export const actions = {
    fetchHabitaciones({ commit }) {
        Axios.get("/getAllHabitaciones").then(res => {
            commit("SET_HABITACIONES", res.data);
        });
    },
    fetchHabitacion({ commit, getters }, id) {
        var habitacion = getters.getHabitacionById(id);
        if (habitacion) {
            commit("SET_HABITACION", habitacion);
        } else {
            Axios.get("/habitacion/" + id)
                .then(res => {
                    commit("SET_HABITACION", res.data);
                })
                .catch(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        }
    }
};

export const getters = {
    getHabitacionById: state => id => {
        return state.habitaciones.find(habitacion => habitacion.id == id);
    }
};
