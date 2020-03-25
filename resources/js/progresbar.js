import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#008f39',
    failedColor: '#874b4b',
    thickness: '2px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 500
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)


