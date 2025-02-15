//poner mayuscula la primer letra con capitalize
Vue.filter("capitalize", function(value) {
    if (value == null) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

//poner el rol del usuario con letras con roleText

Vue.filter("roleText", function(value) {
    if (value == null) return "";
    if (value == 1) return "Administrador";
    if (value == 2) return "Usuario";
});

//filtros para las habitaciones
Vue.filter("piso", function(value) {
    if (value == null) return "";
    if (value == 1) return "Primer piso";
    if (value == 2) return "Segundo piso";
    if (value == 3) return "Tercer piso";
    if (value == 4) return "Cuarto piso";
    if (value == 5) return "Quinto piso";
});

Vue.filter("capacidad", function(value) {
    if (value == null) return "";
    if (value == 1) return "Single";
    if (value == 2) return "Doble";
    if (value == 3) return "Triple";
    if (value == 4) return "Cuadruple";
    if (value == 5) return "Quintuple";
});

Vue.filter("estado", function(value) {
    if (value == null) return "";
    if (value == 1) return "Disponible";
    if (value == 0) return "Ocupada";
});

Vue.filter("estadoLimpieza", function(value) {
    if (value == null) return "";
    if (value == 1) return "Limpia";
    if (value == 0) return "Para limpiar";
});

Vue.filter("estadoReserva", function(value) {
    if (value == null) return "";
    if (value == 0) return "Finalizada";
    if (value == 1) return "Pendiente";
});

//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

Vue.filter("formatDate", function(date) {
    return moment(date)
        .locale("es")
        .format("L");
});

Vue.filter("formatDateComplete", function(date) {
    return moment(date)
        .locale("es")
        .format("LL");
});

Vue.filter("formatDateTime", function(date) {
    return moment(date)
        .locale("es")
        .format("LLL");
});

Vue.filter("formatDateTimeComplete", function(date) {
    return moment(date)
        .locale("es")
        .format("LLLL");
});
