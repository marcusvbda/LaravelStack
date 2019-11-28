require('../../app/vStack/Assets/js/components/autoload')
require('./libs/jquery')
require('bootstrap')
require('./components/autoload')
require('./libs/axios')
require('./libs/element')


import Vue from 'vue'
Vue.config.productionTip = false
const vue = new Vue({
    el: '#app',
    data() {
        return {
            csrf_token: $('meta[name="csrf-token"]').attr('content'),
            root_url: $('meta[name="root-url"]').attr('content'),
        }
    }
})
window.vue = vue
require('./helpers')
