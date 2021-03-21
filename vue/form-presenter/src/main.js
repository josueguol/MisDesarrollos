import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';

import store from './store';
import App from './App.vue';
import { routes } from './router';

Vue.config.productionTip = false;

axios.defaults.baseURL = 'https://localhost:5001';
axios.defaults.headers.get['Accepts'] = 'application/json';
axios.defaults.headers.get['Content-Type'] = 'application/json';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes
});

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});
//.$mount('#app');
