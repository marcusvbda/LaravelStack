import Echo from 'laravel-echo'
if (laravel.pusher_key) {
    window.Pusher = require('pusher-js')
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: laravel.pusher_key,
        cluster: laravel.pusher_cluster
    })
}