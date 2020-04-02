//iportacion de componente de la paginacion
Vue.component('pagination', require('laravel-vue-pagination'));

//componente vue principal
Vue.component('app', require('./components/App.vue').default);

//componente para el cambio de monedas
Vue.component('cambio', require('./components/convertidor.vue').default);
