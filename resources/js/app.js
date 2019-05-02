
require('./bootstrap');

window.Vue = require('vue');

Vue.config.ignoredElements = ['video-js']
Vue.component('subscribe-button', require('./components/subscribe-button.vue').default)
require('./components/channel-uploads')

const app = new Vue({
    el: '#app'
});
