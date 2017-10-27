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
    return view('session');
});

Route::post('/session', 'SessionController@currentAuthenticatedUser');
Route::get('/farms', 'FarmsController@listFarms');
Route::get('/farms/create', 'FarmsController@createFarm');
Route::post('/farms', 'FarmsController@storeFarm');
Route::get('/farms/delete', 'FarmsController@deleteFarm');
Route::delete('/farms', 'FarmsController@destroyFarm');