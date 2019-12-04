require('../../../app/vStack/Assets/js/components/autoload')
require('./libs/jquery')
require('bootstrap')
require('./components/autoload')
require('./libs/axios')
require('./libs/element')
require('./helpers')


import Vue from 'vue'
Vue.config.productionTip = false
const vue = new Vue({
    el: '#app'
})
window.vue = vue
import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: laravel.pusher_key,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true
})

window.Echo.private('App.User.' + laravel.user_id)
    .notification((notification) => {
        console.log('notifyyyyy');
        console.log(notification)
    });