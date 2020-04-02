
import ClienteIndex from './components/Clientes/ClienteIndexComponent.vue'

import UserIndex from './components/Users/UserIndexComponent.vue'

import Factura from './components/FacturaComponent.vue'

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
        component: ClienteIndex,
        name: 'ClienteIndex'
    },

    {
        path: '/users',
        component: UserIndex,
        name: 'UserIndex'
    },

    {
        path: '/*',
        component: notFound,
        name: 'notFound'
    },





];
