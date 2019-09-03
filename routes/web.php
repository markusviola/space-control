<?php

use App\Events\WebsocketDemoEvent;
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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/chats/forms', 'ChatsController@fetchForms');

Route::post('/chats/messages', 'ChatsController@sendMessage');

Route::get('/chats/{id}', 'ChatsController@index')->name('messenger');

Route::get('/chats/messages/{id}', 'ChatsController@fetchMessages');

Route::get('/forms/{id}/dates', 'FormsController@getFormDates');

Route::patch('/forms/{id}/approve', 'FormsController@approveForm');

Route::resource('forms', 'FormsController');

Route::get('/reservations', 'ReservationsController@index')->name('manager');

Route::patch('/reservations/{id}/edit', 'ReservationsController@update');
