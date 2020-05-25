<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'ParkController@index')->name('index')->middleware('auth');

// Менеджер
Route::middleware(['auth','can:all-parks'])->group(function () {
    // показать все парки
    Route::get('/parks', 'ParkController@show')->name('park_show');
    // создать/редактировать парка
    Route::get('/park_edit/{id?}', 'ParkController@edit')->name('park_edit');
    // сохранение парка
    Route::post('/park_update', 'ParkController@update')->name('park_update');
    // удаление парка
    Route::delete('/park_delete', 'ParkController@delete')->name('park_delete');
    // показать все автомобили
    Route::get('/all_trucks', 'TruckController@index')->name('truck_index');
    // удалить автомобиль
    Route::delete('/truck_delete', 'TruckController@delete')->name('truck_delete');
    // получить информацию об автомобиле (по госномеру)
    Route::get('/truck', 'TruckController@info')->name('truck_info');
});

// Водитель
Route::middleware(['auth','can:only-own-trucks'])->group(function () {
    // показать автомобили пользователя-водителя
    Route::get('/my_trucks', 'TruckController@show')->name('truck_show');
    // создать/редактировать автомобиль
    Route::get('/truck_edit/{id?}', 'TruckController@edit')->name('truck_edit');
    // сохранение автомобиля
    Route::post('/truck_update', 'TruckController@update')->name('truck_update');
});




