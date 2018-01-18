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

Route::get('/', 'MainController@home')->name('home');
Route::get('/home', 'MainController@home');

Route::get('/comments/{id}', 'MainController@comments')->name('comments');
Route::delete('/comments/delete/{id}', 'MainController@commentsDelete');
Route::get('/comments/edit/{id}', 'MainController@commentsEdit');
Route::put('/comments/update/{id}', 'MainController@commentsUpdate');
Route::post('/comments/add', 'MainController@commentsAdd');

Route::get('/post', 'MainController@post');
Route::post('/post/add', 'MainController@postAdd');
Route::delete('/post/delete/{id}', 'MainController@postDelete');
Route::get('/post/edit/{id}', 'MainController@postEdit');
Route::put('/post/update/{id}', 'MainController@postUpdate');

