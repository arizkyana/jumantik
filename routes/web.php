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

// Siswa
Route::get('/siswa/add', 'SiswaController@add')->name('siswa/add');
Route::get('/siswa/list', 'SiswaController@list')->name('siswa/list');
Route::post('/siswa/add', 'SiswaController@add');

// Sekolah
Route::get('/sekolah/add', 'SekolahController@add')->name('sekolah/add');
Route::post('/sekolah/add', 'SekolahController@add');

// Jadwal
Route::get('/jadwal', 'JadwalController@index')->name('jadwal');

// Perwalian
Route::get('/perwalian', 'PerwalianController@index')->name('perwalian');


/**
 * Configuration
 */
// Menu
Route::resource('menu', 'MenuController');
Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/create', 'MenuController@create')->name('menu/create');
Route::get('/menu/{menu}/edit', 'MenuController@edit')->name('menu/edit');

// Role
Route::resource('role', 'RoleController');
Route::get('/role', 'RoleController@index')->name('role');
Route::get('/role/create', 'RoleController@create')->name('role/create');
Route::get('/role/{role}/edit', 'RoleController@edit')->name('role/edit');