require('./bootstrap');
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
window.Vue = require('vue');
Vue.config.productionTip = false

/* HOME */
Vue.component('popular-books', require('./components/home/PopularBooks.vue').default);
Vue.component('last-discussed', require('./components/home/LastDiscussed.vue').default);
Vue.component('active-presentations', require('./components/home/ActivePresentations.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
