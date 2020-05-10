import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import store from "./store";
import routes from './router'

// require('./bootstrap');

// window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('navigation', require('./components/Navigation.vue').default);

const app = new Vue({
  el: '#app',
  store,
  router: new VueRouter(routes),
});