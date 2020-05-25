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

Route::get('/parks', 'ParkController@show')->name('park_show')->middleware('auth','can:all-parks');

Route::get('/park_edit/{id?}', 'ParkController@edit')->name('park_edit')->middleware('auth','can:all-parks');

Route::post('/park_update', 'ParkController@update')->name('park_update')->middleware('auth','can:all-parks');

Route::delete('/park_delete', 'ParkController@delete')->name('park_delete')->middleware('auth','can:all-parks');

Route::get('/all_trucks', 'TruckController@index')->name('truck_index')->middleware('auth', 'can:all-parks');

Route::get('/my_trucks', 'TruckController@show')->name('truck_show')->middleware('auth', 'can:only-own-trucks');

Route::get('/truck_edit/{id?}', 'TruckController@edit')->name('truck_edit')->middleware('auth', 'can:only-own-trucks');

Route::get('/truck', 'TruckController@info')->name('truck_info')->middleware('auth');
