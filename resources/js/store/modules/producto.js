import Axios from "axios";

export const namespaced = true;

export const state = {
    productos: [],
    producto: {}
};

export const mutations = {
    SET_PRODUCTOS(state, productos) {
        state.productos = productos;
    },
    SET_PRODUCTO(state, producto) {
        state.producto = producto;
    }
};

export const actions = {
    fetchAllProductos({ commit }) {
        Axios.get("/getAllProductos").then(res => {
            commit("SET_PRODUCTOS", res.data);
        });
    },
    fetchProducto({ commit }, id) {
        Axios.get("/getProducto/" + id).then(res => {
            commit("SET_PRODUCTO", res.data);
        });
    }
};
