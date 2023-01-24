<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterLoginController;

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
Route::get('/message/{message_id}/ogp.png', 'PostController@ogp');
Route::get('/info', 'PostController@info');
Route::get('auth/login/twitter', [TwitterLoginController::class, 'redirectToProvider'])->name('twitter.login');
Route::get('auth/twitter/callback',[TwitterLoginController::class, 'handleProviderCallback']);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@check')->middleware('auth'); 
Route::post('/box/{id}', 'PostController@post');
Route::get('/edit_caption', 'Auth\TimelineController@edit');
Route::post('/edit_caption', 'Auth\TimelineController@edit_done');

