/**
  * First we will load all of this project's JavaScript dependencies which
  * includes Vue and other libraries. It is a great starting point when
  * building robust, powerful web applications using Vue and Laravel.
*/



 require('./bootstrap');
 
 import VuePlyr from 'vue-plyr'
 import 'vue-plyr/dist/vue-plyr.css'

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
 Vue.use(VuePlyr )
 
 
 
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



 /* Orders  Section */
 Vue.component('add-order', require('./components/user/orders/add-order.vue').default);
 Vue.component('rate-ae', require('./components/user/orders/rate-ae.vue').default);
 Vue.component('delete-order', require('./components/user/orders/delete-order.vue').default);
 Vue.component('open-orders-list', require('./components/user/orders/orders-open-lists.vue').default);
 Vue.component('myorders', require('./components/user/orders/myorders.vue').default);
 Vue.component('edit-order', require('./components/user/orders/edit-order.vue').default);
 Vue.component('form-order-chat', require('./components/user/orders/chat/form-order-chat.vue').default);
 Vue.component('hired-list', require('./components/user/orders/hired-list.vue').default);
 Vue.component('manage-order-menu', require('./components/user/orders/manage-order-menu.vue').default);
 Vue.component('canceling-contract', require('./components/user/orders/canceling-contract.vue').default);

 /* Offers Section */
 Vue.component('add-offer', require('./components/user/offers/add-offer.vue').default);
 Vue.component('offers-list', require('./components/user/offers/offers-list.vue').default);
 Vue.component('edit-offer', require('./components/user/offers/edit-offer.vue').default);
 Vue.component('my-offers', require('./components/user/offers/my-offers.vue').default);

 /* Public Section */
 Vue.component('ae-list', require('./components/public/ae-list.vue').default);
 Vue.component('user-ratings-list', require('./components/public/user-ratings-list.vue').default);
 Vue.component('portfolio-section', require('./components/public/portfolio-section.vue').default);
 
 /* Tools */
 Vue.component('report-popup', require('./components/user/tools/report-popup.vue').default);

 /* Tools */
 

 /* Messages Section */
 Vue.component('messages-box', require('./components/user/messages/messages-box.vue').default);
 Vue.component('try-tool', require('./components/try.vue').default);

 /* Deals Chats */
 Vue.component('deal-messages', require('./components/user/deals/deal-messages.vue').default);


 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
 });

 