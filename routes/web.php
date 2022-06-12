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
   // カレンダー画面
   Route::get('/', 'CalendarController@show')->name('top_page');
   // 支出登録画面
   Route::get('calendar/memo', 'CalendarMemoController@show')->name('price_page');
   // データ画面
   Route::get('debug', 'DebugController@show')->name('debug');
   // パラメータ＿支出
   Route::get('calendar/memo/index', 'CalendarMemoController@index')->name('index_page');
   // 収入登録画面
   Route::get('calendar/income', 'CalendarIncomeController@show')->name('income_page');
   // パラメータ＿収入
   Route::get('calendar/income/index', 'CalendarIncomeController@index')->name('index_income_page');

   Route::get('/chart', 'PlaceController@index')->name('chart_page');

   Route::post('/create', 'CalendarMemoController@create')->name('create_page');
   Route::post('/update_delete', 'CalendarMemoController@update')->name('update_delete_page');

   Route::post('/create_income', 'CalendarIncomeController@create')->name('create_income_page');
   Route::post('/update_income', 'CalendarIncomeController@update')->name('update_income_page'); 


   Route::put('/update', 'CalendarMemoController@update');
});
