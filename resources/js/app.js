require("./bootstrap");

window.Vue = require("vue");

//iport lodash para el debounce
import _ from "lodash";

//Import View Router
import router from "./router";

//improt vuex
import store from "./store/store";

//import vform
require("./vform");

//import components
require("./importComponents");

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
