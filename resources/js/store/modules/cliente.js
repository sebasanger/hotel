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
        Axios.get("cliente/" + payload.query + "?page=" + payload.pagina)
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
    fetchCliente({ commit, getters }, id) {
        var cliente = getters.getClienteById(id);
        if (cliente) {
            commit("SET_CLIENTE", cliente);
        } else {
            Axios.get("/cliente/" + id)
                .then(res => {
                    commit("SET_CLIENTE", res.data.data);
                })
                .then(() => {
                    this.$router.push({
                        name: "500"
                    });
                });
        }
    }
};

export const getters = {
    getClienteById: state => id => {
        return state.clientes.data.find(cliente => cliente.id == id);
    },

};
