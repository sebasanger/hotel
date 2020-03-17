
import './bootstrap';
import swal from 'sweetalert';


window.Vue = require('vue');

Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('cliente', require('./components/ClienteComponent.vue').default);


const app = new Vue({
    el: '#app',
});
 