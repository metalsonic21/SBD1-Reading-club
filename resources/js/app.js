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



/* CRUD CLUBS */
Vue.component('create-club', require('./components/browse_clubs/Create.vue').default);
Vue.component('edit-club', require('./components/browse_clubs/Edit.vue').default);
Vue.component('edit-associated', require('./components/browse_clubs/EditAssociated.vue').default);

/* MEMBERS */
Vue.component('club-members', require('./components/club_members/ClubMembers.vue').default); //reports
Vue.component('browse-members', require('./components/club_members/BrowseMembers.vue').default); //crud members

/* PAYMENTS */
Vue.component('payments', require('./components/club_members/Payments.vue').default);
Vue.component('create-payment', require('./components/club_members/CreatePayment.vue').default);
Vue.component('edit-payment', require('./components/club_members/EditPayment.vue').default); 

/* CRUD MEMBERS */
Vue.component('create-member', require('./components/club_members/CreateMember.vue').default);
Vue.component('edit-member', require('./components/club_members/EditMember.vue').default);
Vue.component('free-agent', require('./components/club_members/AddFreeAgent.vue').default);

/* FAVORITE BOOKS */
Vue.component('favorite-books', require('./components/books/Favorites.vue').default);

/* REVIEWED BOOKS*/
Vue.component('available-reports-club', require('./components/club_reports/AvailableReportsClub.vue').default);

/*BROWSE GROUPS*/
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

/* OBRAS */
Vue.component('obras', require('./components/obras/Obras.vue').default);
Vue.component('crear-obra', require('./components/obras/CrearObra.vue').default);
Vue.component('editar-obra', require('./components/obras/EditObra.vue').default);
Vue.component('presentaciones', require('./components/obras/Presentacion.vue').default);
Vue.component('crear-presentacion', require('./components/obras/CrearPresentacion.vue').default);
Vue.component('editar-presentacion', require('./components/obras/EditPresentacion.vue').default);
Vue.component('personajes', require('./components/obras/Personajes.vue').default);
Vue.component('personajes-create', require('./components/obras/PersonajesCreate.vue').default);
Vue.component('personajes-edit', require('./components/obras/PersonajesEdit.vue').default);
Vue.component('locales', require('./components/obras/Locales.vue').default);
Vue.component('crear-local', require('./components/obras/CrearLocal.vue').default);
Vue.component('edit-local', require('./components/obras/EditLocal.vue').default);

/*THEATER PLAYS
Vue.component('plays-clubs', require('./components/theater_plays/PlaysClubs.vue').default);
Vue.component('cast-plays', require('./components/theater_plays/CastPlays.vue').default);
Vue.component('plays-create', require('./components/theater_plays/create.vue').default);
Vue.component('plays-edit', require('./components/theater_plays/edit.vue').default);
Vue.component('character-cast', require('./components/theater_plays/CharacterCast.vue').default);
Vue.component('earning-plays', require('./components/theater_plays/EarningPlays.vue').default);
Vue.component('browse-plays',  require('./components/theater_plays/BrowsePlays.vue').default);
Vue.component('characteradd-cast', require('./components/theater_plays/CharacterCastAdd.vue').default);
Vue.component('character-add', require('./components/theater_plays/character_add.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);*/

/*Obras remake*/


/*CRUD PERFORMANCES
Vue.component('performances', require('./components/theater_plays/performances.vue').default);
Vue.component('performances-edit', require('./components/theater_plays/editperformance.vue').default);
Vue.component('performances-create', require('./components/theater_plays/create_performance.vue').default);
//Vue.commponent('performances-edit',require('').default);
//Vue.commponent('performances-create',require('./components/theater_plays/create_performance.vue').default);*/
//Vue.commponent('performances-create',require('./components/theater_plays/create_performance.vue').default);
/*CAST
Vue.component('cast', require('./components/theater_plays/cast.vue').default);
Vue.component('cast-edit', require('./components/theater_plays/cast.vue').default);
Vue.component('cast-create', require('./components/theater_plays/cast.vue').default);*/
const app = new Vue({
    el: '#app',
});
