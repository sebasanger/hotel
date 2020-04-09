import Reserva from './components/Reservas/ReservaComponent.vue'

import Cliente from './components/Clientes/ClienteComponent.vue'

import Habitacion from './components/Habitaciones/HabitacionComponent.vue'

import User from './components/Users/UserComponent.vue'

import Factura from './components/Facturas/FacturaComponent.vue'

import Motivo from './components/Motivos/MotivoComponent.vue'

import Categoria from './components/Categorias/CategoriaComponent.vue'

import ModoPago from './components/ModosPagos/ModoPagoComponent.vue'

import IngresoProducto from './components/IngresosProductos/IngresoProductoComponent.vue'

import Producto from './components/Productos/ProductoComponent.vue'

import Precio from './components/Precios/PrecioComponent.vue'

import Marca from './components/Marcas/MarcaComponent.vue'

import notFound from './components/notFound.vue'

import Home from './components/home.vue'







export const routes = [{
        path: '/',
        component: Home
    },

    {
        path: '/reservas',
        component: Reserva,
    },

    {
        path: '/facturas',
        component: Factura
    },

    {
        path: '/productos',
        component: Producto,
        name: 'producto'
    },

    {
        path: '/motivos',
        component: Motivo
    },

    {
        path: '/marcas',
        component: Marca
    },

    {
        path: '/precios',
        component: Precio
    },

    {
        path: '/categorias',
        component: Categoria
    },

    {
        path: '/modosPagos',
        component: ModoPago
    },

    {
        path: '/ingresosProductos',
        component: IngresoProducto
    },

    {
        path: '/clientes',
        component: Cliente,
        name: 'ClienteIndex'
    },

    {
        path: '/habitaciones',
        component: Habitacion,
        name: 'habitacionIndex'
    },

    {
        path: '/users',
        component: User,
        name: 'UserIndex'
    },

    {
        path: '/*',
        component: notFound,
        name: 'notFound'
    },

];
