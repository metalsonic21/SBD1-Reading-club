<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*CLUBS*/
Route::resource('/browseclubs', 'clubs\BrowseClubsController');
Route::get('/browseclubs/{id}/editassociated', 'clubs\EditAssociatedController@edit');
Route::put('/browseclubs/{id}/editassociated', 'clubs\EditAssociatedController@update');
Route::get('/members', 'clubs\ReportsClubMembersController@index')->name('members');
Route::get('/clubreports', 'clubs\ClubReportsController@index')->name('clubreports');
Route::get('/selectclub', 'clubs\SelectClubController@index')->name('selectclub');
Route::get('/selectclubg', 'clubs\SelectClubController@group')->name('selectclub');
Route::get('/selectclubgm', 'clubs\SelectClubController@gm')->name('selectclub');
Route::get('/selectclubr', 'clubs\SelectClubController@r')->name('selectclub');
Route::get('/selectclubp', 'clubs\SelectClubController@pres')->name('selectclub');

/* MEMBERS */
Route::resource('/clubs/{club}/members', 'members\MembersController');
Route::get('/clubs/{club}/members/{member}/canAddPayment', 'members\MembersController@canAddPayment')->name('members.verify');

/* DELETE MEMBER FROM CLUB BUT NOT FROM DATABASE */
Route::patch('/clubs/{club}/deletemember/{id}', 'members\MembersController@delete')->name('members.changest');
Route::put('/clubs/{club}/deletemember/{id}', 'members\MembersController@delete')->name('members.changest');
Route::get('/clubs/{club}/deletemember/{id}', 'members\MembersController@delete')->name('members.changest');

/* MAKE FREE AGENT JOIN A NEW CLUB*/
Route::resource('/clubs/{clubs}/freeagent', 'members\FreeAgentController');
Route::get('clubs/{club}/freeagent/{member}/verify', 'members\FreeAgentController@verifyDay')->name('agent.verify');

/* PAYMENTS */
Route::resource('/clubs/{club}/members/{id}/payments', 'members\PagosController');

/*GROUPS*/
Route::resource('/clubs/{club}/groups', 'groups\BrowseGroupsController');
/* SPECIAL DELETE FOR GROUPS */
Route::patch('/clubs/{club}/delgroup/{grupo}', 'groups\BrowseGroupsController@borrar')->name('groups.borrar');
Route::put('/clubs/{club}/delgroup/{grupo}', 'groups\BrowseGroupsController@borrar')->name('groups.borrar');
Route::get('/clubs/{club}/delgroup/{grupo}', 'groups\BrowseGroupsController@borrar')->name('groups.borrar');
Route::get('/clubs/{club}/selectgm', 'groups\SelectGroupController@index')->name('selectgroup');
Route::get('/clubs/{club}/selectg', 'groups\SelectGroupController@r')->name('selectgroupr');

/* GROUP MEMBERS */
Route::resource('/clubs/{club}/groups/{group}/gmembers', 'groups\GroupMembersController');
Route::put('/clubs/{club}/groups/{group}/dropmember/{member}', 'groups\GroupMembersController@borrar')->name('gmembers.borrar');
Route::patch('/clubs/{club}/groups/{group}/dropmember/{member}', 'groups\GroupMembersController@borrar')->name('gmembers.borrar');
Route::get('/clubs/{club}/groups/{group}/dropmember/{member}', 'groups\GroupMembersController@borrar')->name('gmembers.borrar');
/*Verify if I can add a member to a group (conflict with people joining and leaving the same day and primary keys)*/
Route::get('/clubs/{club}/groups/{group}/gmembers/{member}/verify', 'groups\GroupMembersController@verifyDay')->name('gmembers.verify');


/* MEETINGS */
Route::resource('/clubs/{club}/groups/{group}/meetings', 'meetings\MeetingsController');
Route::get('/clubs/{club}/groups/{group}/verifyM', 'meetings\MeetingsController@verifyAdd')->name('meetings.verify');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}/edit', 'meetings\MeetingsController@modificar')->name('meetings.modificar');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');
Route::put('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');
Route::patch('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}/{sesion}/details', 'meetings\MeetingsController@details')->name('meetings.details');

/* ATTENDANCE */
Route::resource('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}/attendance', 'meetings\AttendanceController');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}/verify', 'meetings\AttendanceController@verifyA')->name('meetings.verifyA');
Route::get('/managemeetings/calendar', 'meetings\MeetingsController@calendar')->name('managemeetings');


/* BOOKS */
Route::resource('/books', 'books\BooksController');
Route::resource('/books/{isbn}/structure', 'books\StructuresController');

/* FAVORITE BOOKS */
Route::resource('/clubs/{club}/members/{id}/favorites', 'members\FavoriteBooksController');

/* OBRAS */
Route::resource('/obras', 'obras\ObraController');
Route::resource('/obras/{obra}/personajes', 'obras\PersonajesController');

Route::resource('/clubs/{club}/presentaciones', 'obras\PresentacionController');
Route::get('/clubs/{club}/presentaciones/{fecha}/{obra}/{local}/verifyP', 'obras\PresentacionController@verifyP')->name('presentaciones.verify'); //Verify if presentation exists in DB
Route::resource('/clubs/{club}/locales', 'obras\LocalController');
Route::get('/clubs/{club}/presentaciones/{fec}/{obra}/{local}/edit', 'obras\PresentacionController@mod');
Route::put('/clubs/{club}/presentaciones/{fec}/{obra}/{local}', 'obras\PresentacionController@modificar');
Route::patch('/clubs/{club}/presentaciones/{fec}/{obra}/{local}', 'obras\PresentacionController@modificar');
Route::get('/clubs/{club}/presentaciones/{fec}/{obra}/{local}', 'obras\PresentacionController@modificar');
Route::delete('/clubs/{club}/presentaciones/{fec}/{obra}/{local}', 'obras\PresentacionController@borrar');
