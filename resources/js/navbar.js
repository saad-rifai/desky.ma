
 require('./bootstrap');

 window.Vue = require('vue');
 import Vuesax from 'vuesax'
 import 'material-icons/iconfont/material-icons.css';

import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax, {
  // options here

  
})
 /* Notification */
Vue.component('notification-menu', require('./components/user/notification/notification-menu.vue').default);
const app = new Vue({
    el: '#navbar',
});
