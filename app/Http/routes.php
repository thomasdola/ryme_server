<?php

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

Route::group(['middleware' => ['api'], 'prefix'=>'internal.api'], function(){
    Route::get('/categories', ['as'=>'categories', 'uses'=>'CategoriesController@getCategories']);
    Route::get('/categories/{id}', ['as'=>'category', 'uses'=>'CategoriesController@getCategory']);
    Route::get('/staff', ['as'=>'staff_with_data', 'uses'=>'StaffController@index']);
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    $api->post('register_first_step', ['as'=>'api.register_first', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@join']);
    $api->post('register_second_step', ['as'=>'api.register_second', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@register']);
    $api->post('login', ['as'=>'api.login', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@authenticate']);

    $api->group(['middleware'=>'api.auth'], function($api){

        $api->get('categories', ['as'=>'api.categories', 'uses'=>'App\Http\Controllers\CategoriesController@index']);
        $api->post('categories/{id}', ['as'=>'api.category.toggleFollow', 'uses'=>'App\Http\Controllers\CategoriesController@toggleFollow']);

        $api->put('/users/{id}', ['as'=>'api.user.update', 'uses'=>'App\Http\Controllers\UsersController@update']);

        $api->post('/vouch', ['as'=>'api.vouch.create', 'uses'=>'App\Http\Controllers\VouchesController@create']);
        $api->post('/vouch/{id}', ['as'=>'api.vouch.answer', 'uses'=>'App\Http\Controllers\VouchesController@answer']);

        $api->post('/artists', ['as'=>'api.artist.create', 'uses'=>'App\Http\Controllers\ArtistsController@create']);
        $api->put('/artists/{id}', ['as'=>'api.artist.update', 'uses'=>'App\Http\Controllers\ArtistsController@update']);
        $api->get('/artists/{id}/tracks', ['as'=>'api.artist.tracks', 'uses'=>'App\Http\Controllers\TracksController@list']);
        $api->post('/artists/{id}', ['as'=>'api.artist.follow', 'uses'=>'App\Http\Controllers\ArtistsController@toggleFollow']);

        $api->get('/tracks/{id}', ['as'=>'api.track', 'uses'=>'App\Http\Controllers\TracksController@stream']);
        $api->post('/tracks/{id}/comments', ['as'=>'api.track.comments.store', 'uses'=>'App\Http\Controllers\CommentsController@store']);

        $api->get('/events', ['as'=>'api.events', 'uses'=>'App\Http\Controllers\EventsController@index']);
        $api->post('/events/{id}', ['as'=>'api.events.view', 'uses'=>'App\Http\Controllers\EventsController@viewCount']);
    });
});
