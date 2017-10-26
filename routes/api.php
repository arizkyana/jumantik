<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/login', 'Api\UsersController@login');
    Route::post('/logout', 'Api\UsersController@login');
    Route::post('/forgot', 'Api\UsersController@forgot');
    Route::post('/reset_password', 'Api\UsersController@reset_password');
});


// Kelurahan
Route::prefix('kelurahan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KelurahanController@index');
    Route::get('/get_by_kecamatan/{kecamatan}', 'Api\KelurahanController@get_by_kecamatan');
});

// Kecamatan
Route::prefix('kecamatan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KecamatanController@index');
});

// Laporan
Route::prefix('penyakit')->middleware('simple.token')->group(function () {
    Route::prefix('laporan')->group(function(){
        Route::get('/', 'Api\Penyakit\LaporanController@index');
        Route::post('/store', 'Api\Penyakit\LaporanController@store');
        Route::post('/store_log_kejadian', 'Api\Penyakit\LaporanController@store_log_kejadian');
        Route::get('/show/{laporan}', 'Api\Penyakit\LaporanController@show');
    });
});


// api unauthenticated
Route::get('/403', function () {
    return [
        'message' => 'unauthenticated'
    ];
});