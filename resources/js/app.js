require('./bootstrap');

window.Vue = require('vue');

//improt vuex
import store from './store';

//import vform
require('./vform');


//Import Vue Filter
require('./filter');


//Import progressbar
require('./progresbar');


//Import Sweetalert2
require('./sweetalert');

//importacion de los componentes
require('./importComponents');


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
    routes,
    store
})

//Eventos personalizados
window.Fire = new Vue();

//instacia vue
const app = new Vue({
    el: '#app',
    router,
    store
});
