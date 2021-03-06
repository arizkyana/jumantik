window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {


} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');
let user = document.head.querySelector('meta[name="user"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'
//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

// import Echo from "laravel-echo"
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001'
// });


let countNotification = document.getElementById('count-notification');
let notificationInfo = document.getElementById('notification-info');

// get notification today
function getNotificationToday(){
    window.axios.get('/api/notifikasi/today', {
        params: {user: user.content}
    }).then(function (result) {

        console.log(result);

        if (result.data.data.count == 0) {
            notificationInfo.innerHTML = 'Belum ada laporan terbaru untuk anda';
        } else {
            countNotification.innerHTML = result.data.data.count;
            notificationInfo.innerHTML = 'Anda mempunyai ' + result.data.data.count + ' laporan terbaru';
        }

    }).catch(function (err) {
        console.error(err);
    });
}
getNotificationToday();

setInterval(getNotificationToday, 5000);