require('../../../app/vStack/Assets/js/components/autoload')
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
    el: '#app',
    mounted() {
        if (laravel.user && laravel.pusher_key) {
            this.$http.post(`${laravel.root_url}/admin/notifications/${laravel.user.code}`, {}).then(res => {
                res = res.data
                if (res.notifications) this.makeNotification(res.notifications)
            })
            let route = `App.User.${laravel.user.id}`
            Echo.private(route).notification(n => {
                this.$message({ showClose: true, message: n.message, type: n._type })
                this.$http.post(`${laravel.root_url}/admin/notifications/${laravel.user.code}/set_as_readed`, { id: n.id })
            })
        }
    },
    methods: {
        makeNotification(notes) {
            for (let i in notes) {
                let alert = notes[i].data
                setTimeout(_ => {
                    this.$message({ showClose: true, message: alert.message, type: alert._type })
                }, 100)
            }
        }
    }
})
window.vue = vue

