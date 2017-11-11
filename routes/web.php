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
    return view('home')->with([
        'js' => 'dashboard.js',
        'gmaps' => true
    ]);
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

Route::resource('jadwal', 'JadwalController');
Route::get('/jadwal', 'JadwalController@index')->name('jadwal');
Route::get('/jadwal/create', 'JadwalController@create')->name('jadwal/create');
Route::get('/jadwal/{jadwal}/edit', 'JadwalController@edit')->name('jadwal/edit');



// Penyakit
Route::namespace('Penyakit')->group(function () {
    Route::prefix('penyakit')->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan', 'LaporanController@index')->name('penyakit/laporan');
        Route::get('/laporan/create', 'LaporanController@create')->name('penyakit/laporan/create');
        Route::get('/laporan/{laporan}/edit', 'LaporanController@edit')->name('penyakit/laporan/edit');
        Route::get('/laporan/{laporan}/show', 'LaporanController@show')->name('penyakit/laporan/show');
        Route::put('/laporan/selesai/{laporan}', 'LaporanController@selesai')->name('penyakit/laporan/selesai');
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

// Notification
Route::namespace('Notifikasi')->group(function(){
    Route::prefix('notifikasi')->group(function(){

        Route::resource('history', 'HistoryController');
        Route::get('/', 'HistoryController@index')->name('notifikasi/history');

        Route::resource('setup', 'SetupController');
        Route::get('/', 'SetupController@index')->name('notifikasi/setup');
        Route::get('/create', 'SetupController@create')->name('notifikasi/setup/create');
        Route::get('/{setup}/edit', 'SetupController@edit')->name('notifikasi/setup/edit');
        Route::get('/{setup}/show', 'SetupController@show')->name('notifikasi/setup/show');
        Route::post('/{setup}/send', 'SetupController@send')->name('notifikasi/setup/send');


    });


});

// Master
Route::namespace('Master')->group(function () {
    Route::prefix('master')->group(function () {
        Route::prefix('dinkes')->group(function () {
            Route::resource('dinkes', 'DinkesController');
            Route::get('/', 'DinkesController@index')->name('master/dinkes');
            Route::get('/create', 'DinkesController@create')->name('master/dinkes/create');
            Route::get('/{dinkes}/edit', 'DinkesController@edit')->name('master/dinkes/edit');
        });

        Route::prefix('puskesmas')->group(function () {
            Route::resource('puskesmas', 'PuskesmasController');
            Route::get('/', 'PuskesmasController@index')->name('master/puskesmas');
            Route::get('/create', 'PuskesmasController@create')->name('master/puskesmas/create');
            Route::get('/{dinkes}/edit', 'PuskesmasController@edit')->name('master/puskesmas/edit');
        });

        Route::prefix('rumah_sakit')->group(function () {
            Route::resource('rumahsakit', 'RumahSakitController');
            Route::get('/', 'RumahSakitController@index')->name('master/rumah_sakit');
            Route::get('/create', 'RumahSakitController@create')->name('master/rumah_sakit/create');
            Route::get('/{dinkes}/edit', 'RumahSakitController@edit')->name('master/rumah_sakit/edit');
        });

        Route::prefix('petugas')->group(function () {
            Route::resource('petugas', 'PetugasController');
            Route::get('/', 'PetugasController@index')->name('master/petugas');
            Route::get('/create', 'PetugasController@create')->name('master/petugas/create');
            Route::get('/{dinkes}/edit', 'PetugasController@edit')->name('master/petugas/edit');
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
        Route::get('/role', 'RoleController@index')->name('role')->middleware('can:role');
        Route::get('/role/create', 'RoleController@create')->name('role/create')->middleware('can:role-create');
        Route::get('/role/{role}/edit', 'RoleController@edit')->name('role/edit')->middleware('can:role-edit');

// User
        Route::get('/users/profile', 'UsersController@profile')->name('users/profile');
        Route::resource('users', 'UsersController');
        Route::get('/users', 'UsersController@index')->name('users')->middleware('can:users');
        Route::get('/users/create', 'UsersController@create')->name('users/create')->middleware('can:users-create');
        Route::get('/users/{users}/edit', 'UsersController@edit')->name('users/edit')->middleware('can:users-x');

        // Penyakit
        Route::resource('penyakit', 'PenyakitController');
        Route::get('/penyakit', 'PenyakitController@index')->name('penyakit')->middleware('can:penyakit');
        Route::get('/penyakit/create', 'PenyakitController@create')->name('penyakit/create')->middleware('can:penyakit-create');
        Route::get('/penyakit/{users}/edit', 'PenyakitController@edit')->name('penyakit/edit')->middleware('can:penyakit-edit');

        // Tindakan
        Route::resource('tindakan', 'TindakanController');
        Route::get('/tindakan', 'TindakanController@index')->name('tindakan')->middleware('can:tindakan');
        Route::get('/tindakan/create', 'TindakanController@create')->name('tindakan/create')->middleware('can:tindakan-create');
        Route::get('/tindakan/{users}/edit', 'TindakanController@edit')->name('tindakan/edit')->middleware('can:tindakan-edit');

        // Status
        Route::resource('status', 'StatusController');
        Route::get('/status', 'StatusController@index')->name('status')->middleware('can:status');
        Route::get('/status/create', 'StatusController@create')->name('status/create')->middleware('can:status-create');
        Route::get('/status/{users}/edit', 'StatusController@edit')->name('status/edit')->middleware('can:status-edit');

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