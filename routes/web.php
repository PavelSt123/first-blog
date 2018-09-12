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

Route::get('/', 'PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/create_post', 'PostsController@create')->middleware('auth');

Route::post('/create_post', 'PostsController@store')->middleware('auth');

Route::get('/posts/{id}', 'PostsController@show');

Route::get('/posts/{id}/edit', 'PostsController@edit')->middleware('auth');

Route::put('/posts/{id}', 'PostsController@update')->middleware('auth');
Route::patch('/posts/{id}', 'PostsController@update')->middleware('auth');

Route::get('/posts/{id}/delete', 'PostsController@destroy')->middleware('auth');