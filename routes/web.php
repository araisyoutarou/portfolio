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



Auth::routes();



Route::group(['middleware' => 'auth'], function() {
   Route::get('/', 'CalendarController@show')->name('top_page');
   Route::get('calendar/memo', 'CalendarMemoController@show')->name('next_page');
   Route::get('calendar/memo/edit', 'CalendarMemoController@edit')->name('edit_page');
   Route::get('debug', 'DebugController@show')->name('debug');
   Route::get('calendar/memo', 'CalendarMemoController@index')->name('index_page');
   
   Route::post('/create', 'CalendarMemoController@create')->name('create_page');
   Route::post('calendar/memo/edit', 'CalendarMemoController@update')->name('update_page'); 
});
