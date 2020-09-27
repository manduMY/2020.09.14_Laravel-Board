require('./bootstrap');

window.Vue = require('vue');
Vue.config.devtools = true;
Vue.config.performance = true;

import App from './App.vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue';


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(VueRouter)
Vue.use(VueAxios, axios);

const router = new VueRouter({
    // mode: 'history',
    routes: routes
});

const app = new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
});