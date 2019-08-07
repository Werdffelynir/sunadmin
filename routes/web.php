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

Route::get('/chunks', 'ChunksController@list')->name('chunks');
Route::get('/chunk/create', 'ChunksController@create')->name('chunks/create');
Route::get('/chunk/edit/id', 'ChunksController@create')->name('chunks/create');
Route::post('/chunk/save', 'ChunksController@save')->name('chunks/save');
Route::post('/chunk/delete/id', 'ChunksController@create')->name('chunks/create');

Route::get('/mixins', 'MixinsController@list')->name('mixins');
Route::get('/mixin/create', 'MixinsController@create')->name('mixins/create');
Route::get('/mixin/edit/id', 'MixinsController@create')->name('mixins/create');
Route::post('/mixin/save', 'MixinsController@create')->name('mixins/create');
Route::post('/mixin/delete/id', 'MixinsController@create')->name('mixins/create');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
