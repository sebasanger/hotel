import './bootstrap';
import swal from 'sweetalert';
import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)



const Bar = {
    template: '<div>home</div>'
}

const routes = [{
        path: '/cliente',
        name: 'cliente',
        component: () => import('./components/ClienteComponent.vue')
    },

    {
        path: '/factura',
        name: 'factura',
        component: () => import('./components/FacturaComponent.vue')
    }
]

const router = new VueRouter({
    routes // short for `routes: routes`
})

window.Vue = require('vue');






const app = new Vue({
    router
}).$mount('#app')
