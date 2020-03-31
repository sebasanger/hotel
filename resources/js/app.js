require('./bootstrap');

window.Vue = require('vue');

//improt vuex
require('./store');

//import vform
require('./vform');


//Import Vue Filter
require('./filter');


//Import progressbar
require('./progresbar');


//Import Sweetalert2
require('./sweetalert');

//iportacion de componente de la paginacion
Vue.component('pagination', require('laravel-vue-pagination'));

//iport lodash para el debounce
import _ from 'lodash';

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
