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


/*BROWSE CLUBS*/
Vue.component('browse-clubs', require('./components/browse_clubs/BrowseClubs.vue').default);

/* MEMBERS REPORTS */
Vue.component('club-members', require('./components/club_members/ClubMembers.vue').default);

/* REVIEWED BOOKS*/
Vue.component('available-reports-club', require('./components/club_reports/AvailableReportsClub.vue').default);

/*BROWSE GROUPS*/
Vue.component('browse-groups', require('./components/browse_groups/BrowseGroups.vue').default);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
