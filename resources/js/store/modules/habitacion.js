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
            let data = res.data;
            commit("SET_HABITACIONES", data);
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
    },
    habitacionesDisponibles: state => {
        return state.habitaciones.filter(
            habitacion => habitacion.estado == 1 && habitacion.id != 1
        );
    },
    habitacionesReales: state => {
        return state.habitaciones.filter(habitacion => habitacion.id != 1);
    },

    habitacionesConImagenes: state => {
        return state.habitaciones.filter(
            habitacion =>
                (habitacion.id != 1 && habitacion.image_path != null) ||
                habitacion.image_path2 != null ||
                habitacion.image_path3 != null
        );
    }
};
