<?php

use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/list', 'ChunksController@list')->name('list');
Route::get('/chunk/editor/{id?}', 'ChunksController@editor')->name('chunk/editor');
Route::post('/chunks/type', 'ChunksController@chunksType')->name('chunks/type');
Route::post('/chunk/save', 'ChunksController@save')->name('chunks/save');
Route::post('/chunk/remove', 'ChunksController@remove')->name('chunks/remove');

