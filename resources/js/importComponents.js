//importacion de los componentes base automaticamente
import upperFirst from "lodash/upperFirst";
import camelCase from "lodash/camelCase";
const requireComponent = require.context(
    "./components",
    false,
    /Base[A-Z]\w+\.(vue|js)$/
);
requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName);

    const componentName = upperFirst(
        camelCase(fileName.replace(/^\.\/(.*)\.\w+$/, "$1"))
    );

    Vue.component(
        componentName,

        componentConfig.default || componentConfig
    );
});

//iportacion de componente de la paginacion
Vue.component("pagination", require("laravel-vue-pagination"));

//componente para el cambio de monedas
Vue.component("cambio", require("./components/convertidor.vue").default);

//componente para el cambio de monedas
Vue.component("App", require("./components/App.vue").default);
