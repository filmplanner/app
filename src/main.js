import Vue from 'vue';
import { sync } from 'vuex-router-sync';

import BootstrapVue from 'bootstrap-vue';
import Bootstrap from 'bootstrap';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'font-awesome/css/font-awesome.css';

import App from './App';
import store from './store';
import router from './router';

Vue.use(Bootstrap);
Vue.use(BootstrapVue);

Vue.config.productionTip = false;

// sync store and router
sync(store, router);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  render: (h) => {
    return h(App);
  },
});
