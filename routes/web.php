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
    return redirect('/home');
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
Route::get('/survey/{laporan}/laporan', 'SurveyController@laporan')->name('survey/laporan')->middleware('can:survey-laporan');


// Penyakit
Route::namespace('Penyakit')->group(function () {
    Route::prefix('penyakit')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('penyakit/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('penyakit/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('penyakit/laporan/edit');
        Route::get('/laporan/show/{laporan}', 'LaporanController@show')->name('penyakit/laporan/show');

    });
});

// Jumantik
Route::namespace('Jumantik')->group(function () {
    Route::prefix('jumantik')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('jumantik/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('jumantik/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('jumantik/laporan/edit');
    });
});

// Puskesmas
Route::namespace('Puskesmas')->group(function () {
    Route::prefix('puskesmas')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('puskesmas/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('puskesmas/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('puskesmas/laporan/edit');
    });
});

// Rumah Sakit
Route::namespace('Rs')->group(function () {
    Route::prefix('rs')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('rs/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('rs/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('rs/laporan/edit');
    });
});

// Dinkes
Route::namespace('Dinkes')->group(function () {
    Route::prefix('dinkes')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('dinkes/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('dinkes/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('dinkes/laporan/edit');

        Route::resource('jadwal', 'JadwalController');
        Route::get('/jadwal', 'JadwalController@index')->name('dinkes/jadwal');
        Route::get('/jadwal/create', 'JadwalController@create')->name('dinkes/jadwal/create');
        Route::get('/jadwal/{jadwal}/edit', 'JadwalController@edit')->name('dinkes/jadwal/edit');
    });


});

// maps
Route::get('/maps', 'MapsController@index')->name('maps');

/**
 * Setting
 */
Route::namespace('Setting')->group(function () {
    Route::prefix('setting')->group(function () {
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
        Route::get('/users/profile', 'UsersController@profile')->name('users/profile');
        Route::resource('users', 'UsersController');
        Route::get('/users', 'UsersController@index')->name('users')->middleware('can:users');
        Route::get('/users/create', 'UsersController@create')->name('users/create')->middleware('can:users-create');
        Route::get('/users/{users}/edit', 'UsersController@edit')->name('users/edit')->middleware('can:users-edit');
    });
});


// API
Route::resource('apiClient', 'ApiClientController');
Route::get('/apiClient', 'ApiClientController@index')->name('apiClient')->middleware('can:apiClient');
Route::get('/apiClient/create', 'ApiClientController@create')->name('apiClient/create')->middleware('can:apiClient-create');
Route::get('/apiClient/{apiClient}/edit', 'ApiClientController@edit')->name('apiClient/edit')->middleware('can:apiClient-edit');