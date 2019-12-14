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
Route::get('/members', 'clubs\ReportsClubMembersController@index')->name('members');
Route::get('/clubreports', 'clubs\ClubReportsController@index')->name('clubreports');
Route::get('/selectclub', 'clubs\SelectClubController@index')->name('selectclub');
Route::get('/selectclubg', 'clubs\SelectClubController@group')->name('selectclub');
Route::get('/selectclubgm', 'clubs\SelectClubController@gm')->name('selectclub');
Route::get('/selectclubr', 'clubs\SelectClubController@r')->name('selectclub');

/* MEMBERS */
Route::resource('/clubs/{club}/members', 'clubs\MembersController');

/* DELETE MEMBER FROM CLUB BUT NOT FROM DATABASE */
Route::patch('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');
Route::put('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');
Route::get('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');

/* MAKE FREE AGENT JOIN A NEW CLUB*/
Route::resource('/clubs/{clubs}/freeagent', 'clubs\FreeAgentController');

/* PAYMENTS */
Route::resource('/clubs/{club}/members/{id}/payments', 'clubs\PagosController');

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


/* MEETINGS */
Route::resource('/clubs/{club}/groups/{group}/meetings', 'meetings\MeetingsController');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}/edit', 'meetings\MeetingsController@modificar')->name('meetings.modificar');
Route::get('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');
Route::put('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');
Route::patch('/clubs/{club}/groups/{group}/meetings/{date}/{mod}/{libro}', 'meetings\MeetingsController@concluir')->name('meetings.concluir');

Route::get('/managemeetings/calendar', 'meetings\MeetingsController@calendar')->name('managemeetings');


/* BOOKS */
Route::resource('/books', 'books\BooksController');
Route::resource('/books/{isbn}/structure', 'books\StructuresController');

/* FAVORITE BOOKS */
Route::resource('/clubs/{club}/members/{id}/favorites', 'books\FavoriteBooksController');

/*THEATER_PLAYS*/
Route::get('/playsclubs', 'theater_plays\PlaysClubsController@index')->name('playsclubs');
Route::get('/castplayss/{id}','theater_plays\CastPlaysController@obrasclub');
Route::get('charactercast/character_add', 'theater_plays\CastPlaysController@add'); 
Route::get('/charactercast', 'theater_plays\CharacterCastController@index')->name('charactercast');
Route::get('/earningplays', 'theater_plays\EarningPlaysController@index')->name('earningplays');
Route::get('/browseplays', 'theater_plays\BrowsePlaysController@index')->name('browseplays');
Route::get('/charactercastadd', 'theater_plays\CharacterCastAddController@index')->name('charactercastadd');
//Route::resource('/castplays', 'theater_plays\CastPlaysController');
Route::resource('/castplays', 'theater_plays\playsController');
