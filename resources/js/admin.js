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
Vue.component('opt-check', require('./components/auth/admin/opt-check.vue').default);







const app = new Vue({
    el: '#admin',
});

