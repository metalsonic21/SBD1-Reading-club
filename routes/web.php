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
Route::resource('/managemembers', 'clubs\MembersController');

/*GROUPS*/
Route::get('/browsegroups', 'groups\BrowseGroupsController@index')->name('browsegroups');
Route::get('/selectgroup', 'groups\SelectGroupController@index')->name('selectgroup');
Route::get('/selectgroupr', 'groups\SelectGroupRController@index')->name('selectgroup');
Route::get('/managemembersg', 'groups\GroupMembersController@index')->name('managemembers');

/* MEETINGS */
Route::get('/managemeetings', 'meetings\MeetingsController@index')->name('managemeetings');
Route::get('/managemeetings/calendar', 'meetings\MeetingsController@calendar')->name('managemeetings');


/* BOOKS */
Route::resource('/books', 'books\BooksController');

/*THEATER_PLAYS*/
Route::get('/playsclubs', 'theater_plays\PlaysClubsController@index')->name('playsclubs');
Route::get('/castplays', 'theater_plays\CastPlaysController@index')->name('castplays');
Route::get('/charactercast', 'theater_plays\CharacterCastController@index')->name('charactercast');

Route::get('/earningplays', 'theater_plays\EarningPlaysController@index')->name('earningplays');

Route::get('/browseplays', 'theater_plays\BrowsePlaysController@index')->name('browseplays');
Route::get('/charactercastadd', 'theater_plays\CharacterCastAddController@index')->name('charactercastadd');