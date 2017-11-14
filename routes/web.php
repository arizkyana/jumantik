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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('can:dashboard');

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

Route::resource('jadwal', 'JadwalController');
Route::get('/jadwal', 'JadwalController@index')->name('jadwal')->middleware('can:jadwal');
Route::get('/jadwal/create', 'JadwalController@create')->name('jadwal/create')->middleware('can:jadwal-create');
Route::get('/jadwal/{jadwal}/edit', 'JadwalController@edit')->name('jadwal/edit')->middleware('can:jadwal-edit');
//Route::get('/jadwal/wilayah/{users}', 'JadwalController@wilayah')->name('jadwal/wilayah')->middleware('can:jadwal-wilayah');


// Penyakit
Route::namespace('Penyakit')->group(function () {
    Route::prefix('penyakit')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('penyakit/laporan')->middleware('can:penyakit-laporan');
//        Route::get('/laporan/create', 'LaporanController@create')->name('penyakit/laporan/create')->middleware('can:penyakit-laporan-create');
//        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('penyakit/laporan/edit')->middleware('can:penyakit-laporan-edit');
        Route::get('/laporan/{laporan}/show', 'LaporanController@show')->name('penyakit/laporan/show')->middleware('can:penyakit-laporan-show');
        Route::put('/laporan/selesai/{laporan}', 'LaporanController@selesai')->name('penyakit/laporan/selesai')->middleware('can:penyakit-laporan-selesai');
    });
});


// Notification
Route::namespace('Notifikasi')->group(function(){
    Route::prefix('notifikasi')->group(function(){

        Route::resource('history', 'HistoryController');
        Route::get('/history', 'HistoryController@index')->name('notifikasi/history')->middleware('can:notifikasi-history');

        Route::resource('setup', 'SetupController');
        Route::get('/setup', 'SetupController@index')->name('notifikasi/setup')->middleware('can:notifikasi-setup');
        Route::get('/create', 'SetupController@create')->name('notifikasi/setup/create')->middleware('can:notifikasi-setup-create');
        Route::get('/{setup}/edit', 'SetupController@edit')->name('notifikasi/setup/edit')->middleware('can:notifikasi-setup-edit');
        Route::get('/{setup}/show', 'SetupController@show')->name('notifikasi/setup/show')->middleware('can:notifikasi-setup-show');
        Route::post('/{setup}/send', 'SetupController@send')->name('notifikasi/setup/send')->middleware('can:notifikasi-setup-send');

    });


});

// Master
Route::namespace('Master')->group(function () {
    Route::prefix('master')->group(function () {
        Route::prefix('dinkes')->group(function () {
            Route::resource('dinkes', 'DinkesController');
            Route::get('/', 'DinkesController@index')->name('master/dinkes')->middleware('can:master-dinkes');
            Route::get('/create', 'DinkesController@create')->name('master/dinkes/create')->middleware('can:master-dinkes-create');
            Route::get('/{dinkes}/edit', 'DinkesController@edit')->name('master/dinkes/edit')->middleware('can:master-dinkes-edit');
        });

        Route::prefix('puskesmas')->group(function () {
            Route::resource('puskesmas', 'PuskesmasController');
            Route::get('/', 'PuskesmasController@index')->middleware('can:master-puskesmas');
            Route::get('/create', 'PuskesmasController@create')->name('master/puskesmas/create')->middleware('can:master-puskesmas-create');
            Route::get('/{dinkes}/edit', 'PuskesmasController@edit')->name('master/puskesmas/edit')->middleware('can:master-puskesmas-edit');
        });

        Route::prefix('rumah_sakit')->group(function () {
            Route::resource('rumahsakit', 'RumahSakitController');
            Route::get('/', 'RumahSakitController@index')->name('master/rumah_sakit')->middleware('can:master-rumah_sakit');
            Route::get('/create', 'RumahSakitController@create')->name('master/rumah_sakit/create')->middleware('can:master-rumah_sakit-create');
            Route::get('/{dinkes}/edit', 'RumahSakitController@edit')->name('master/rumah_sakit/edit')->middleware('can:master-rumah_sakit-edit');
        });

        Route::prefix('petugas')->group(function () {
            Route::resource('petugas', 'PetugasController');
            Route::get('/', 'PetugasController@index')->name('master/petugas')->middleware('can:master-petugas');
            Route::get('/create', 'PetugasController@create')->name('master/petugas/create')->middleware('can:master-petugas-create');
            Route::get('/{dinkes}/edit', 'PetugasController@edit')->name('master/petugas/edit')->middleware('can:master-petugas-edit');
        });

        Route::prefix('ketua_warga')->group(function () {
            Route::resource('ketuawarga', 'KetuaWargaController');
            Route::get('/', 'KetuaWargaController@index')->name('master/ketua_warga')->middleware('can:master-ketua_warga');
            Route::get('/create', 'KetuaWargaController@create')->name('master/ketua_warga/create')->middleware('can:master-ketua_warga-create');
            Route::get('/{ketua_warga}/edit', 'KetuaWargaController@edit')->name('master/ketua_warga/edit')->middleware('can:master-ketua_warga-edit');
        });


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
        Route::get('/role', 'RoleController@index')->name('role')->middleware('can:setting-role');
        Route::get('/role/create', 'RoleController@create')->name('role/create')->middleware('can:setting-role-create');
        Route::get('/role/{role}/edit', 'RoleController@edit')->name('role/edit')->middleware('can:setting-role-edit');

// User
        Route::get('/users/profile', 'UsersController@profile')->name('users/profile');
        Route::resource('users', 'UsersController');
        Route::get('/users', 'UsersController@index')->name('users')->middleware('can:setting-users');
        Route::get('/users/create', 'UsersController@create')->name('users/create')->middleware('can:setting-users-create');
        Route::get('/users/{users}/edit', 'UsersController@edit')->name('users/edit')->middleware('can:setting-users-edit');

        // Penyakit
        Route::resource('penyakit', 'PenyakitController');
        Route::get('/penyakit', 'PenyakitController@index')->name('penyakit')->middleware('can:setting-penyakit');
        Route::get('/penyakit/create', 'PenyakitController@create')->name('penyakit/create')->middleware('can:setting-penyakit-create');
        Route::get('/penyakit/{users}/edit', 'PenyakitController@edit')->name('penyakit/edit')->middleware('can:setting-penyakit-edit');

        // Tindakan
        Route::resource('tindakan', 'TindakanController');
        Route::get('/tindakan', 'TindakanController@index')->name('tindakan')->middleware('can:setting-tindakan');
        Route::get('/tindakan/create', 'TindakanController@create')->name('tindakan/create')->middleware('can:setting-tindakan-create');
        Route::get('/tindakan/{users}/edit', 'TindakanController@edit')->name('tindakan/edit')->middleware('can:setting-tindakan-edit');

        // Status
        Route::resource('status', 'StatusController');
        Route::get('/status', 'StatusController@index')->name('status')->middleware('can:setting-status');
        Route::get('/status/create', 'StatusController@create')->name('status/create')->middleware('can:setting-status-create');
        Route::get('/status/{users}/edit', 'StatusController@edit')->name('status/edit')->middleware('can:setting-status-edit');

    });
});


// API
Route::resource('apiClient', 'ApiClientController');
Route::get('/apiClient', 'ApiClientController@index')->name('apiClient')->middleware('can:apiClient');
Route::get('/apiClient/create', 'ApiClientController@create')->name('apiClient/create')->middleware('can:apiClient-create');
Route::get('/apiClient/{apiClient}/edit', 'ApiClientController@edit')->name('apiClient/edit')->middleware('can:apiClient-edit');

// Media Access
Route::get('/media/{filename}', function ($filename) {

    $path = storage_path('app/uploads') . "/" . $filename;

    if (!\Illuminate\Support\Facades\File::exists($path)) abort(404);
    $file = \Illuminate\Support\Facades\File::get($path);
    $type = \Illuminate\Support\Facades\File::mimeType($path);

    header('Content-type', $type);
    return response()
        ->file($path);


})->name('media');