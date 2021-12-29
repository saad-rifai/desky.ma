/**
  * First we will load all of this project's JavaScript dependencies which
  * includes Vue and other libraries. It is a great starting point when
  * building robust, powerful web applications using Vue and Laravel.
*/



require('./bootstrap');


window.Vue = require('vue');
import Vuesax from 'vuesax';

import 'material-icons/iconfont/material-icons.css';

import 'vuesax/dist/vuesax.css' //Vuesax styles
import Vue from 'vue';
import moment from 'moment';
Vue.prototype.moment = moment

Vue.use(Vuesax, {
  // options here
})



//opt-check
Vue.component('otp-check', require('./components/auth/admin/otp-check.vue').default);
Vue.component('table-orders-pending-review', require('./components/auth/admin/dashboard/orders/table-orders-pending-review.vue').default);
Vue.component('review-order-modal', require('./components/auth/admin/dashboard/orders/review-order-modal.vue').default);
Vue.component('review-order-modal', require('./components/auth/admin/dashboard/orders/review-order-modal.vue').default);
// Ae Account
Vue.component('table-aeaccount-pending-review', require('./components/auth/admin/dashboard/users/aeaccount/table-aeaccount-pending-review.vue').default);
Vue.component('review-request-aeaccount-modal', require('./components/auth/admin/dashboard/users/aeaccount/review-request-aeaccount.vue').default);






const app = new Vue({
    el: '#admin',
});

