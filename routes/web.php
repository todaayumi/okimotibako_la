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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/box/{id}', 'PostController@index');
Route::get('/posted', 'PostController@posted');
Route::get('/message/{message_id}', 'PostController@message');
Route::get('/list/{id}', 'PostController@list');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/box/{id}', 'PostController@post');
Route::get('/timeline', 'Auth\TimelineController@index');
