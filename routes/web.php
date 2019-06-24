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
    return view('welcome');
});
Route::post('/users', 'UserController@storeAction')
    ->name('users.create');

Route::put('/users/{user}', 'UserController@updateAction')
    ->where('user', '[0-9]+')
    ->name('users.update');

Route::delete('users/{user}', 'UserController@destroyAction')
    ->name('users.destroy');

Route::get('/users/{user}', 'UserController@showAction')
    ->where('user', '[0-9]+')
    ->name('users.show');

Route::get('/users', 'UserController@indexAction')
    ->name('users.index');

Route::get('/users/new', 'UserController@newAction')
    ->name('users.new');

Route::get('/users/{user}/edit', 'UserController@editAction')
    ->where('user', '[0-9]+')
    ->name('users.edit');
