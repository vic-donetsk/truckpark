<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', 'ParkController@index')->name('index')->middleware('auth');

Route::get('/parks', 'ParkController@show')->name('park_show')->middleware('can:all-parks');

Route::post('/park_update', 'ParkController@update')->name('park_update')->middleware('can:all-parks');

Route::delete('/park_delete', 'ParkController@delete')->name('park_delete')->middleware('can:all-parks');

Route::get('/trucks', 'TruckController@show')->name('truck_show')->middleware('can:only-own-trucks');
