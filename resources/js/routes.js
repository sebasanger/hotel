import App from './components/App.vue'

import ClienteIndex from './components/Clientes/ClienteIndexComponent.vue'
import ClienteCreate from './components/Clientes/ClienteCreateComponent.vue'
import ClienteEdit from './components/Clientes/ClienteEditComponent.vue'

import UserIndex from './components/Users/UserIndexComponent.vue'

import Factura from './components/FacturaComponent.vue'



export const routes = [

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
        path: '/editar/cliente/:id',
        component: ClienteEdit,
        name: 'ClienteEdit'
    },

    {
        path: '/agregar/cliente',
        component: ClienteCreate,
        name: 'ClienteCreate'

    },



    {
        path: '/users',
        component: UserIndex,
        name: 'UserIndex'
    },



];
