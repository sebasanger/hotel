require('./bootstrap');

window.Vue = require('vue');

//Import Vue Filter
require('./filter'); 

//Import progressbar
require('./progressbar'); 

//Setup custom events 
require('./customEvents'); 

//Import View Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Import Sweetalert2
import Swal from 'sweetalert'
window.Swal = Swal



//Import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Routes
import { routes } from './routes';

//Register Routes
const router = new VueRouter({
    routes, 
    mode: 'hash',

})

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});