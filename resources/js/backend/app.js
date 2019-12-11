require('../../../vendor/marcusvbda/vstack/src/Assets/js/components/autoload')
require('./libs/jquery')
require('bootstrap')
require('./components/autoload')
require('./libs/axios')
require('./libs/element')
require('./helpers')
require('./libs/echo')


import Vue from 'vue'
Vue.config.productionTip = false
const vue = new Vue({
    el: '#vue_app',
    mounted() {
        if (laravel.user) {
            this.$http.post(`${laravel.root_url}/admin/vstack/notifications/${laravel.user.code}`, {}).then(res => {
                res = res.data
                if (res.notifications) this.alerts = res.notifications
            })
            if (laravel.user && laravel.pusher_key) {
                let route = `App.User.${laravel.user.id}`
                Echo.private(route).notification(n => {
                    this.$message({ showClose: true, message: n.message, type: n._type })
                    this.$http.delete(`${laravel.root_url}/admin/vstack/notifications/${laravel.user.code}/${n.id}/destroy`, {})
                })
            }
        }
    }
})
window.vue = vue

