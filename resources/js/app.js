
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });


Echo.private('App.Models.User.'+authId)
    .notification((notification) => {
            console.log(notification.message);
            console.log(notification);
        // var result = notification.message;
        // var notification_container = $('.notification_container');
        // var content = "<div class='alert alert-" + notification.alert_type+"' role='alert'><a href='"+ notification.redirect_url +"'> "+ result +" </a> </div>";
        // notification_container.prepend(content);
        if (notification.redirect_url){
            toastr.options.onclick = function() { location.href = notification.redirect_url };
            toastr.success(notification.title, 'New Notification');
        }else {
            toastr.success(notification.title, 'New Notification');
        }

        var notifsec =  $('.notif-count-notification');
        notifsec.text( notifsec.text() == '' ? 1 : parseInt(notifsec.text()) + 1).addClass('active');

    });