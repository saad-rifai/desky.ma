/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 import Vuesax from 'vuesax'
 import 'material-icons/iconfont/material-icons.css';

import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax, {
  // options here
})
 
 
 
 /**
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 Vue.component('register-form', require('./components/auth/register-form.vue').default);
 Vue.component('reset-form', require('./components/auth/reset-form.vue').default);
 Vue.component('update-password', require('./components/auth/update-password.vue').default);
 Vue.component('login-form', require('./components/auth/login-form.vue').default);
 
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 
 /* User Section */
 Vue.component('account-settings', require('./components/user/account-settings.vue').default);
 Vue.component('public-profile-edit', require('./components/user/public-profile-edit.vue').default);
 Vue.component('request-verification', require('./components/user/request-verification.vue').default);
 Vue.component('request-ae-account', require('./components/user/request-ae-account.vue').default);
 Vue.component('add-to-portfolio', require('./components/user/add-to-portfolio.vue').default);
 Vue.component('like-portfolio', require('./components/user/like-portfolio.vue').default);
 Vue.component('delete-portfolio', require('./components/user/delete-from-portfolio.vue').default);
 Vue.component('edit-portfolio', require('./components/user/edit-portfolio.vue').default);
 Vue.component('add-order', require('./components/user/orders/add-order.vue').default);
 
 /* Public Section */
 Vue.component('ae-list', require('./components/public/ae-list.vue').default);
 Vue.component('user-ratings-list', require('./components/public/user-ratings-list.vue').default);
 Vue.component('portfolio-section', require('./components/public/portfolio-section.vue').default);
 
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
 });
 