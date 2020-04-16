import Vue from "vue";

import Router from "vue-router";

import Reserva from "./components/Reservas/ReservaComponent.vue";

import Cliente from "./components/ClienteComponent.vue";

import Habitacion from "./components/HabitacionComponent.vue";

import User from "./components/Users/UserComponent.vue";

import Factura from "./components/FacturaComponent.vue";

import Motivo from "./components/MotivoComponent.vue";

import Categoria from "./components/CategoriaComponent.vue";

import ModoPago from "./components/ModoPagoComponent.vue";

import IngresoProducto from "./components/IngresoProductoComponent.vue";

import Producto from "./components/ProductoComponent.vue";

import Precio from "./components/PrecioComponent.vue";

import Marca from "./components/MarcaComponent.vue";

import NotFound from "./components/notFound.vue";

import Home from "./components/home.vue";

import reservashow from "./components/reservaShow.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/",
            component: Home,
            name: "home"
        },
        {
            path: "/reserva/:id",
            component: reservashow,
            name: "reservaShow",
            props: true
        },

        {
            path: "/reservas",
            component: Reserva,
            name: "reserva"
        },

        {
            path: "/facturas",
            component: Factura,
            name: "tipoFactura"
        },

        {
            path: "/productos",
            component: Producto,
            name: "producto"
        },

        {
            path: "/motivos",
            component: Motivo,
            name: "motivo"
        },

        {
            path: "/marcas",
            component: Marca,
            name: "marca"
        },

        {
            path: "/precios",
            component: Precio,
            name: "precio"
        },

        {
            path: "/categorias",
            component: Categoria,
            name: "categoria"
        },

        {
            path: "/modosPagos",
            component: ModoPago,
            name: "modoPago"
        },

        {
            path: "/ingresosProductos",
            component: IngresoProducto,
            name: "ingresoProducto"
        },

        {
            path: "/clientes",
            component: Cliente,
            name: "cliente"
        },

        {
            path: "/habitaciones",
            component: Habitacion,
            name: "habitacion"
        },

        {
            path: "/users",
            component: User,
            name: "user"
        },

        {
            path: "/*",
            component: NotFound,
            name: "notFound"
        }
    ]
});
