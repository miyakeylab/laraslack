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
    logger('test');
    return view('welcome');
});

Route::get('/test', 'SlackTestController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/slack/request', 'SlackApiController@sendSlack')->name('slack.send');

Route::post('/slack/response', 'SlackApiController@receiveSlack')->name('slack.receive');
