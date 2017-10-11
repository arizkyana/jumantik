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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// laporan
Route::resource('laporan', 'LaporanController');
Route::get('/laporan', 'LaporanController@index')->name('laporan')->middleware('can:laporan');
Route::get('/laporan/create', 'LaporanController@create')->name('laporan/create')->middleware('can:laporan-create');
Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('laporan/edit')->middleware('can:laporan-edit');

// survey
Route::resource('survey', 'SurveyController');
Route::get('/survey', 'SurveyController@index')->name('survey')->middleware('can:survey');
Route::get('/survey/create', 'SurveyController@create')->name('survey/create')->middleware('can:survey-create');
Route::get('/survey/{survey}/edit', 'SurveyController@edit')->name('survey/edit')->middleware('can:survey-edit');
Route::get('/survey/laporan', 'SurveyController@laporan')->name('survey/laporan')->middleware('can:survey-laporan');

// maps
Route::get('/maps', 'MapsController@index')->name('maps');

/**
 * Configuration
 */
// Menu
Route::resource('menu', 'MenuController');
Route::get('/menu', 'MenuController@index')->name('menu')->middleware('can:menu');
Route::get('/menu/create', 'MenuController@create')->name('menu/create')->middleware('can:menu-create');
Route::get('/menu/{menu}/edit', 'MenuController@edit')->name('menu/edit')->middleware('can:menu-edit');

// Role
Route::resource('role', 'RoleController');
Route::get('/role', 'RoleController@index')->name('role')->middleware('can:role');
Route::get('/role/create', 'RoleController@create')->name('role/create')->middleware('can:role-create');
Route::get('/role/{role}/edit', 'RoleController@edit')->name('role/edit')->middleware('can:role-edit');

// User
Route::resource('users', 'UsersController');
Route::get('/users', 'UsersController@index')->name('users')->middleware('can:users');
Route::get('/users/create', 'UsersController@create')->name('users/create')->middleware('can:users-create');
Route::get('/users/{users}/edit', 'UsersController@edit')->name('users/edit')->middleware('can:users-edit');