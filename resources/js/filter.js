//poner mayuscula la primer letra con capitalize
Vue.filter("capitalize", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

//poner el rol del usuario con letras con roleText

Vue.filter("roleText", function(value) {
    if (!value) return "";
    if (value === 1) return "Administrador";
    if (value === 2) return "Usuario";
});

//filtros para las habitaciones
Vue.filter("piso", function(value) {
    if (!value) return "";
    if (value === 1) return "Primer piso";
    if (value === 2) return "Segundo piso";
    if (value === 3) return "Tercer piso";
    if (value === 4) return "Cuarto piso";
    if (value === 5) return "Quinto piso";
});

Vue.filter("capacidad", function(value) {
    if (!value) return "";
    if (value === 1) return "Single";
    if (value === 2) return "Doble";
    if (value === 3) return "Triple";
    if (value === 4) return "Cuadruple";
    if (value === 5) return "Quintuple";
});

Vue.filter("estado", function(value) {
    if (!value) return "";
    if (value === 1) return "Disponible";
    if (value === 2) return "Ocupada";
    if (value === 3) return "Para limpiar";
});

Vue.filter("single", function(value) {
    if (!value) return "";
    if (value === 1) return '<i class="fa fa-bed red"></i>';
    if (value === 2) return "Ocupada";
    if (value === 3) return "Para limpiar";
});

//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

Vue.filter("formatDate", function(date) {
    return moment(date).format("DD/MM/YYYY");
});
