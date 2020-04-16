require("./bootstrap");

window.Vue = require("vue");

//iport lodash para el debounce
import _ from "lodash";

//iportacion de componente de la paginacion
Vue.component("pagination", require("laravel-vue-pagination"));

//componente para el cambio de monedas
Vue.component("cambio", require("./components/convertidor.vue").default);

//componente para el cambio de monedas
Vue.component("App", require("./components/App.vue").default);

//Import View Router
import router from "./router";

//improt vuex
import store from "./store/store";

//import vform
require("./vform");

//Import Vue Filter
require("./filter");

//Import progressbar
require("./progresbar");

//Import Sweetalert2
require("./sweetalert");

//Eventos personalizados
window.Fire = new Vue();

//instacia vue
const app = new Vue({
    el: "#app",
    router,
    store
});
