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
    data() {
        return {
            sidebarCollapse: false
        }
    },
    created() {
        this.$pace.start()
        this.init()
    },
    mounted() {
        this.$pace.stop()
    },
    methods: {
        init() {
            this.sidebarCollapse = Cookies.get("sidebarCollapse") == 1
            if (laravel.user) {
                if (laravel.user.code) {
                    this.$http.post(`${laravel.general.root_url}/admin/vstack/notifications/${laravel.user.code}`, {}).then(res => {
                        res = res.data
                        if (res.notifications) this.alerts = res.notifications
                    })
                    if (laravel.user.code && laravel.chat.pusher_key) {
                        Echo.private(`App.User.${laravel.user.id}`).notification(n => {
                            this.$message({ showClose: true, message: n.message, type: n._type })
                            this.$http.delete(`${laravel.general.root_url}/admin/vstack/notifications/${laravel.user.code}/${n.id}/destroy`, {})
                        })
                    }
                }
            }
        }
    }
})
window.vue = vue

