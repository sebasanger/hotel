import Cliente from './components/ClienteComponent.vue'
import Factura from './components/FacturaComponent.vue'
import Home from './components/HomeComponent.vue'    


export const routes = [
    {
        path: '/',
        component: Home
    },

    {
        path: '/factura',
        component: Factura
    },

    {
        path: '/cliente',
        component: Cliente
    },



];

