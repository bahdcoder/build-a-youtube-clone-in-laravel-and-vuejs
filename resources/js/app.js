
require('./bootstrap');

window.Vue = require('vue');


require('./components/subscribe-button')
require('./components/channel-uploads')

const app = new Vue({
    el: '#app'
});
