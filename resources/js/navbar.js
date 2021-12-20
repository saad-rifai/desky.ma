 require('./bootstrap');
 import { DropdownPlugin, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)



 window.Vue = require('vue');
 import moment from 'moment';
Vue.prototype.moment = moment
 import Vuesax from 'vuesax'
 import 'material-icons/iconfont/material-icons.css';
 import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax, {
  // options here
})
// Make BootstrapVue available throughout your project
Vue.use(DropdownPlugin)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)









 /* Notification */
Vue.component('notification-menu', require('./components/user/notification/notification-menu.vue').default);

/* Messages */
Vue.component('nav-menu-messages', require('./components/user/messages/nav-menu-messages.vue').default);

/* Navbar Menu */

Vue.component('navbar-menu', require('./components/auth/navbar-menu.vue').default);




const app = new Vue({
  el: '#navbar',
});
