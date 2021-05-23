/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import { Form, HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
import VueRouter from "vue-router";
import VeeValidate from "vee-validate";
import FileSelector from "vue-file-selector";
import { data } from "jquery";
import * as Ladda from "ladda";
import Vue from "vue";
window.invoice = require('invoice-number');

// then use it!
window.Ladda = Ladda;
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
Vue.use(FileSelector);
Vue.use(VueRouter);
Vue.directive('clickoutside', {
    inserted: (el, binding, vnode) => {
  // assign event to the element
      el.clickOutsideEvent = function (event) {
        // here we check if the click event is outside the element and it's children
        if (!(el == event.target || el.contains(event.target))) {
          // if clicked outside, call the provided method
          vnode.context[binding.expression](event)
        }
      }
  // register click and touch events
      document.body.addEventListener('click', el.clickOutsideEvent)
      document.body.addEventListener('touchstart', el.clickOutsideEvent)
    },
    unbind: function (el) {
  // unregister click and touch events before the element is unmounted
      document.body.removeEventListener('click', el.clickOutsideEvent)
      document.body.removeEventListener('touchstart', el.clickOutsideEvent)
    },
    stopProp(event) {
      event.stopPropagation()
    },
  })
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//from-demande-card.vue
Vue.component(
    "binga-test",
    require("./components/binga-test.vue").default
);
Vue.component(
    "packs",
    require("./components/packs.vue").default
);
Vue.component(
    "register-form",
    require("./components/register-form.vue").default
);
Vue.component(
    "credit-card-settings",
    require("./components/credit-card-settings.vue").default
);
Vue.component(
    "devis-modification",
    require("./components/devis-modification.vue").default
);
Vue.component(
    "year-line-chart-desky",
    require("./components/year-line-chart-desky.vue").default
);
Vue.component(
    "notification-badge",
    require("./components/notification-badge.vue").default
);
Vue.component(
    "user-notification",
    require("./components/user-notification.vue").default
);
Vue.component(
    "user-general-setting",
    require("./components/user-general-setting.vue").default
);
Vue.component(
    "more-infos-update",
    require("./components/more-infos-update.vue").default
);
Vue.component(
    "more-infos",
    require("./components/more-infos.vue").default
);

Vue.component(
    "list-devis",
    require("./components/list-devis.vue").default
);
Vue.component(
    "view-devis",
    require("./components/view-devis.vue").default
);
Vue.component(
    "form-devis",
    require("./components/form-devis.vue").default
);
Vue.component(
    "payment-methods",
    require("./components/payments-methods.vue").default
);
Vue.component(
    "cart",
    require("./components/cart.vue").default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        RIB_BANK: "050 640 009 01075325 720 01 78",
        BANK_NAME: " CFG BANK",
        BANK_HOLDER: "NERYOU",
        P_cart_auto: "250",
        P_demande_etude: "1000",
        P_CONSULTATION: "150",
        infos: [],
        coupon_cost: "",
        totalprice: "",
        apikey:"35O3VOQQJCE947HA55EGCD07VFT32XCPDPMZET5H"
    },

});
