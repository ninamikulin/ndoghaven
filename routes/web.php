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

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Articles
Route::get('/articles/create', 'ArticleController@create');
Route::post('/articles', 'ArticleController@store');
Route::get('/articles/{article}', 'ArticleController@show');
Route::get('/articles/{article}/edit', 'ArticleController@edit');
Route::put('/articles/{article}', 'ArticleController@update');
Route::delete('/articles/{article}', 'ArticleController@destroy');

// Tags
Route::get('/categories/{tag}', 'ArticlesTagController@index');

// User Profile
Route::get('/profile/{user}', 'UserController@show');
Route::get('/profile/{user}/edit', 'UserController@edit');
Route::put('/profile/{user}', 'UserController@update');
Route::get('/profile/{user}/articles', 'UserController@showArticles');
