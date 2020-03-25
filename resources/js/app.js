require('./bootstrap');
window.Vue = require('vue');

//import vform
require('./vform');


//Import Vue Filter
require('./filter');


//Import progressbar
require('./progresbar');


//Import Sweetalert2
require('./sweetalert');

//Import View Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Routes
import {
    routes
} from './routes';

//Register Routes
const router = new VueRouter({
    mode: 'history',
    routes
})

//Eventos personalizados
window.Fire = new Vue();



Vue.component('app', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router
});
