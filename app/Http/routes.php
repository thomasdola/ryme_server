<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('pages.welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web'], 'prefix'=>'admin'], function () {
    Route::get('/',['as'=>'dashboard', 'uses'=>'PagesController@dashboard']);

    Route::get('/artists', ['as'=>'artists', 'uses'=>'ArtistsController@index']);
    Route::get('/artists/show', ['as'=>'artist', 'uses'=>'ArtistsController@show']);

    Route::resource('categories', 'CategoriesController');

    Route::resource('users', 'UsersController');

    Route::resource('ads', 'AdsController');

    Route::get('/settings', ['as'=>'settings', 'uses'=>'AdminController@index']);
});
