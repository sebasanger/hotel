import Axios from "axios";

export const namespaced = true;

export const state = {
    user: {}
};

export const mutations = {
    SET_USER(state, user) {
        state.user = user;
    }
};

export const actions = {
    fetchUser({ commit, dispatch }) {
        Axios.get("/userFind")
            .then(res => {
                commit("SET_USER", res.data);
                const notification = {
                    type: "success",
                    message: "usuario cargado"
                };
                dispatch("notification/add", notification, { root: true });
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "hubo un error al cargar el usurio actual"
                };
                dispatch("notification/add", notification, { root: true });
            });
    }
};
