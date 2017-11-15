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
    Route::post('/registration', 'Api\UsersController@registration');
    Route::post('/reset_password', 'Api\UsersController@reset_password');
    Route::get('/roles', 'Api\UsersController@roles');

});


// Kelurahan
Route::prefix('kelurahan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KelurahanController@index');
    Route::get('/get_by_kecamatan/{kecamatan}', 'Api\KelurahanController@get_by_kecamatan');
});

// Kecamatan
Route::prefix('kecamatan')->middleware('simple.token')->group(function () {
    Route::get('/', 'Api\KecamatanController@index');
    Route::get('/area', 'Api\KecamatanController@area_kecamatan');
});

// Jadwal
Route::prefix('jadwal')->middleware('simple.token')->group(function(){
    Route::get('/', 'Api\JadwalController@index');
    Route::get('/wilayah/{user}', 'Api\JadwalController@wilayah');
});

// Dashboard
Route::prefix('dashboard')->group(function(){
   Route::get('/jumantik', 'Api\DashboardController@jumantik');
   Route::get('/penyakit_nyamuk_menular', 'Api\DashboardController@penyakit_nyamuk_menular');
});

// Laporan
Route::prefix('penyakit')->middleware('simple.token')->group(function () {
    Route::prefix('laporan')->group(function(){
        Route::get('/', 'Api\Penyakit\LaporanController@index');
        Route::post('/store', 'Api\Penyakit\LaporanController@store');
        Route::post('/store_log_kejadian', 'Api\Penyakit\LaporanController@store_log_kejadian');
        Route::get('/show/{laporan}', 'Api\Penyakit\LaporanController@show');
        Route::post('/ajax_laporan', 'Api\Penyakit\LaporanController@ajax_laporan');
        Route::get('/delete/{laporan}', 'Api\Penyakit\LaporanController@delete');
        Route::put('/edit/{laporan}', 'Api\Penyakit\LaporanController@edit');

    });

    Route::prefix('detail_laporan')->group(function(){
        Route::post('/store', 'Api\Penyakit\DetailLaporanController@store');
        Route::post('/approval/{detail_laporan}', 'Api\Penyakit\DetailLaporanController@approval');
    });
});

// Master
Route::prefix('master')->middleware('simple.token')->group(function(){
   Route::get('/apartment', 'Api\Master\ApartementController@index');
   Route::get('/faskes', 'Api\Master\FaskesController@index');
   Route::get('/perkimtan', 'Api\Master\PerkimtanController@index');
   Route::get('/sekolah', 'Api\Master\SekolahController@index');
   Route::get('/perumahan', 'Api\Master\PerumahanController@index');
   Route::get('/tindakan', 'Api\Master\TindakanController@index');
   Route::get('/status', function(){
      $status = [
          'deleted' => [
              'id' => 0,
              'name' => 'Deleted'
          ],
          'open' => [
              'id' => 1,
              'name' => 'Open'
          ],
          'finish' => [
              'id' => 2,
              'name' => 'Finish'
          ],
          'on_going' => [
              'id' => 3,
              'name' => 'On Going'
          ],
          'surveyed' => [
              'id' => 4,
              'name' => 'Surveyed'
          ]
      ];

      return $status;
   });
});

// Notifikasi
Route::prefix('notifikasi')->middleware('simple.token')->group(function(){
   Route::get('/', 'Api\Notifikasi\SetupController@index');
});

// api unauthenticated
Route::get('/403', function () {
    return [
        'message' => 'unauthenticated'
    ];
});


Route::post('/test_fcm', function(Request $request){
   return 'ini test fcm';
});