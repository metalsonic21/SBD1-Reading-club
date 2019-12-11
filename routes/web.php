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
Route::get('/selectclubg', 'clubs\SelectClubGController@index')->name('selectclub');
Route::get('/selectclubgm', 'clubs\SelectClubGMController@index')->name('selectclub');
Route::get('/selectclubr', 'clubs\SelectClubRController@index')->name('selectclub');
Route::resource('/clubs/{club}/members', 'clubs\MembersController');
Route::patch('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');
Route::put('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');
Route::get('/clubs/{club}/deletemember/{id}', 'clubs\MembersController@delete')->name('members.changest');

/*GROUPS*/
Route::resource('/browsegroups', 'groups\BrowseGroupsController');
Route::resource('/managemembersg', 'groups\GroupMembersController');
Route::get('/selectgroup', 'groups\SelectGroupController@index')->name('selectgroup');
Route::get('/selectgroupr', 'groups\SelectGroupRController@index')->name('selectgroup');

/* MEETINGS */
Route::get('/managemeetings', 'meetings\MeetingsController@index')->name('managemeetings');
Route::get('/managemeetings/calendar', 'meetings\MeetingsController@calendar')->name('managemeetings');


/* BOOKS */
Route::resource('/books', 'books\BooksController');
Route::resource('/books/{isbn}/structure', 'books\StructuresController');

/*THEATER_PLAYS*/
Route::get('/playsclubs', 'theater_plays\PlaysClubsController@index')->name('playsclubs');
Route::resource('/castplays', 'theater_plays\CastPlaysController');
Route::get('charactercast/character_add', 'theater_plays\CastPlaysController@add'); 
Route::get('/charactercast', 'theater_plays\CharacterCastController@index')->name('charactercast');
Route::get('/earningplays', 'theater_plays\EarningPlaysController@index')->name('earningplays');
Route::get('/browseplays', 'theater_plays\BrowsePlaysController@index')->name('browseplays');
Route::get('/charactercastadd', 'theater_plays\CharacterCastAddController@index')->name('charactercastadd');