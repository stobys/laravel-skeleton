try {
    // window.Popper = require('popper.js').default;
    window._ = require('lodash');
    window.Swal = require('sweetalert2');
    window.$ = window.jQuery = require('jquery');
    window.toastr = require('toastr');
    window.Mustache = require('mustache');

    window.vAPP = new (require('./vAPP').default)();
    
    // window.axios = require('axios');
    // window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    
    // window.Vue = require('vue').default;
    
    require('bootstrap');
    require('./alpine');

} catch (e) {
    console.log(e.message);
}

// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
