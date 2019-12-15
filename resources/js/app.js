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

/* CRUD CLUBS */
Vue.component('create-club', require('./components/browse_clubs/Create.vue').default);
Vue.component('edit-club', require('./components/browse_clubs/Edit.vue').default);

/* MEMBERS */
Vue.component('club-members', require('./components/club_members/ClubMembers.vue').default); //reports
Vue.component('browse-members', require('./components/club_members/BrowseMembers.vue').default); //crud members

/* PAYMENTS */
Vue.component('create-payment', require('./components/club_members/CreatePayment.vue').default);
Vue.component('edit-payment', require('./components/club_members/EditPayment.vue').default); 

/* CRUD MEMBERS */
Vue.component('create-member', require('./components/browse_clubs/CreateMember.vue').default);
Vue.component('edit-member', require('./components/browse_clubs/EditMember.vue').default);
Vue.component('free-agent', require('./components/club_members/AddFreeAgent.vue').default);

/* FAVORITE BOOKS */
Vue.component('favorite-books', require('./components/books/Favorites.vue').default);

/* REVIEWED BOOKS*/
Vue.component('available-reports-club', require('./components/club_reports/AvailableReportsClub.vue').default);

/*BROWSE GROUPS*/
Vue.component('browse-groups', require('./components/browse_groups/BrowseGroups.vue').default);
Vue.component('create-group', require('./components/browse_groups/CreateGroup.vue').default);
Vue.component('edit-group', require('./components/browse_groups/EditGroup.vue').default);
Vue.component('select-group', require('./components/browse_groups/SelectGroup.vue').default);
Vue.component('group-members', require('./components/browse_groups/BrowseMembers.vue').default);

/* CRUD GROUP MEMBERS*/
Vue.component('create-group-member', require('./components/browse_groups/CreateGroupMember.vue').default);

/*MEETINGS*/
Vue.component('meetings', require('./components/browse_meetings/BrowseMeetings.vue').default);
Vue.component('meeting-details', require('./components/browse_meetings/Details.vue').default);
Vue.component('meeting-attendance', require('./components/browse_meetings/Attendance.vue').default);
Vue.component('create-meeting', require('./components/browse_meetings/Create.vue').default);
Vue.component('edit-meeting', require('./components/browse_meetings/Edit.vue').default);

/* BOOKS */
Vue.component('books-create', require('./components/books/Create.vue').default);
Vue.component('books-edit', require('./components/books/Edit.vue').default);
Vue.component('struct-create', require('./components/books/StructAdd.vue').default);
Vue.component('struct-edit', require('./components/books/StructEdit.vue').default);

/*THEATER PLAYS*/
Vue.component('plays-clubs', require('./components/theater_plays/PlaysClubs.vue').default);
Vue.component('cast-plays', require('./components/theater_plays/CastPlays.vue').default);
Vue.component('plays-create', require('./components/theater_plays/create.vue').default);
Vue.component('plays-edit', require('./components/theater_plays/edit.vue').default);
Vue.component('character-cast', require('./components/theater_plays/CharacterCast.vue').default);
Vue.component('earning-plays', require('./components/theater_plays/EarningPlays.vue').default);
Vue.component('browse-plays',  require('./components/theater_plays/BrowsePlays.vue').default);
Vue.component('characteradd-cast', require('./components/theater_plays/CharacterCastAdd.vue').default);
Vue.component('character-add', require('./components/theater_plays/character_add.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
