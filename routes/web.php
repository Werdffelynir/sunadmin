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


Route::get('/list', 'ChunksController@list')->name('list');
//Route::get('/chunk/editor', 'ChunksController@editor')->name('chunk/editor');
Route::get('/chunk/editor/{id?}', 'ChunksController@editor')->name('chunk/editor');


Route::post('/chunks/type', 'ChunksController@chunksType')->name('chunks/type');



Route::post('/chunk/save', 'ChunksController@save')->name('chunks/save');
Route::post('/chunk/delete/id', 'ChunksController@create')->name('chunks/delete');

//Route::get('/mixins', 'MixinsController@list')->name('mixins');
//Route::get('/mixin/create', 'MixinsController@create')->name('mixins/create');
//Route::get('/mixin/edit/id', 'MixinsController@create')->name('mixins/edit');
//Route::post('/mixin/save', 'MixinsController@create')->name('mixins/save');
//Route::post('/mixin/delete/id', 'MixinsController@create')->name('mixins/delete');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
