import Vue from "vue";

import Router from "vue-router";

import Reserva from "./components/ReservaComponent.vue";

import Cliente from "./components/Cliente/ClienteComponent.vue";

import Habitacion from "./components/Habitacion/HabitacionComponent.vue";

import HabitacionShow from "./components/Habitacion/HabitacionShow.vue";

import User from "./components/ExtraComponents/UserComponent.vue";

import Factura from "./components/ExtraComponents/FacturaComponent.vue";

import Motivo from "./components/ExtraComponents/MotivoComponent.vue";

import Categoria from "./components/ExtraComponents/CategoriaComponent.vue";

import ModoPago from "./components/ExtraComponents/ModoPagoComponent.vue";

import IngresoProducto from "./components/ExtraComponents/IngresoProductoComponent.vue";

import Producto from "./components/ProductoComponent.vue";

import Precio from "./components/ExtraComponents/PrecioComponent.vue";

import Marca from "./components/ExtraComponents/MarcaComponent.vue";

import Home from "./components/home.vue";

import reservashow from "./components/reservaShow.vue";

import NotFound from "../views/notFound.vue";

import network from "../views/NetworkIssue.vue";

import store from "./store/store";

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
            path: "/habitacion/:id",
            component: HabitacionShow,
            name: "habitacionShow",
            props: true
        },

        {
            path: "/users",
            component: User,
            name: "user"
        },

        {
            path: "/404",
            component: NotFound,
            name: "404"
        },

        {
            path: "/500",
            component: network,
            name: "500"
        },

        {
            path: "/*",
            redirect: { name: "404" }
        }
    ]
});
