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

Route::prefix('auth')->group(function(){
   Route::get('/login', 'Api\UsersController@login');
   Route::get('/forgot', 'Api\UsersController@forgot');
   Route::get('/reset_password', 'Api\UsersController@reset_password');
});


// Kelurahan
Route::prefix('kelurahan')->group(function(){
    Route::get('/get_by_kecamatan/{kecamatan}', 'Api\KelurahanController@get_by_kecamatan');
});
