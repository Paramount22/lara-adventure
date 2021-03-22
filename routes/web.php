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

use Illuminate\Http\Resources\Json\Resource;
Auth::routes();


Route::get('/', 'DudeController@index');

Route::resource('dudes', 'DudeController' )->only('show');
Route::get('user/{user}', 'UserController@show')->name('show.user');
Route::get('tag/{tag}', 'TagController@show')->name('show.tag');



Route::get('add', 'DudeController@create')->name('create')->middleware('auth');
Route::post('add', 'DudeController@store')->name('store')->middleware('auth');
Route::get('dudes/{dudes}/edit', 'DudeController@edit')->name('edit.dude')->middleware('auth');
Route::put('dudes/{dudes}', 'DudeController@update')->name('update.dude')->middleware('auth');
Route::get('dudes/{dudes}/delete','DudeController@delete')->name('delete.dude')->middleware('auth');
Route::delete('dudes/{dudes}','DudeController@destroy')->name('destroy.dude')->middleware('auth');

Route::resource('comments', 'CommentController' )->only('store')->middleware('auth');
Route::get('comment/{comment}/delete', 'CommentController@destroy')->middleware('auth'); // delete comment
Route::put('comment/{comment}', 'CommentController@update')->name('update.comment')->middleware('auth');


