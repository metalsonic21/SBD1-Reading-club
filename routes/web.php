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
Route::get('/browseclubs', 'clubs\BrowseClubsController@index')->name('browseclubs');
Route::get('/members', 'clubs\ReportsClubMembersController@index')->name('members');
Route::get('/clubreports', 'clubs\ClubReportsController@index')->name('clubreports');
Route::get('/selectclub', 'clubs\SelectClubController@index')->name('selectclub');
Route::get('/managemembers', 'clubs\MembersController@index')->name('managemembers');

/*GROUPS*/
Route::get('/browsegroups', 'groups\BrowseGroupsController@index')->name('browsegroups');

