//poner mayuscula la primer letra con capitalize
Vue.filter('capitalize', function (value) {
	if (!value) return ''
	value = value.toString()
	return value.charAt(0).toUpperCase() + value.slice(1)
  })

//poner el rol del usuario con letras con roleText

Vue.filter('roleText', function (value) {
	if (!value) return ''
	if (value === 1) return 'Administrador'
	if (value === 2) return 'Usuario'
  })



//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

Vue.filter("formatDate", function(date) {

	return moment(date).format('MMMM Do YYYY');

});
