
import Cliente from './components/Clientes/ClienteComponent.vue'

import Habitacion from './components/Habitaciones/HabitacionComponent.vue'

import User from './components/Users/UserComponent.vue'

import Factura from './components/Facturas/FacturaComponent.vue'

import notFound from './components/notFound.vue'

import Home from './components/home.vue'





export const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/facturas',
        component: Factura
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
