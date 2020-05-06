import Axios from "axios";

export const namespaced = true;

export const state = {
    clientes: {},
    cliente: {}
};

export const mutations = {
    SET_CLIENTES(state, clientes) {
        state.clientes = clientes;
    },
    SET_CLIENTE(state, cliente) {
        state.cliente = cliente;
    }
};

export const actions = {
    fetchClientes({ commit, dispatch }, payload) {
        Axios.get("/cliente/" + payload.query + "?page=" + payload.pagina)
            .then(res => {
                commit("SET_CLIENTES", res.data);
            })
            .catch(err => {
                const notification = {
                    type: "error",
                    message: "No se pudieron cargar los clientes"
                };
                dispatch("notification/add", notification, { root: true });
            });
    },
    fetchCliente({ commit }, id) {
        Axios.get("/findCliente/" + id)
            .then(res => {
                commit("SET_CLIENTE", res.data);
            })
            .catch(() => {
                this.$router.push({
                    name: "500"
                });
            });
    }
};
