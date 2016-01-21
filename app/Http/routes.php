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
    Route::get('/dashboard',['as'=>'dashboard', 'uses'=>'PagesController@dashboard']);

    Route::get('/artists', ['as'=>'artists', 'uses'=>'ArtistsController@index']);
    Route::get('/artists/show', ['as'=>'artist', 'uses'=>'ArtistsController@show']);

    Route::resource('categories', 'CategoriesController');

    Route::resource('users', 'UsersController');

    Route::resource('ads', 'AdsController');

    Route::get('/settings', ['as'=>'settings', 'uses'=>'AdminController@index']);
});

Route::group(['prefix'=>'internal', 'middleware' => ['api']], function(){
    Route::get('/dashboard/data', ['as'=>'dashboard.data', 'uses'=>'PagesController@getDashboardData']);
    Route::get('/artists/data', ['as'=>'artists.data', 'uses'=>'ArtistsController@getArtistsPageData']);

    Route::group(['namespace'=>'InternalApi'], function(){
        //Artists Page Internal Api ==> sort of (:)
        Route::get('/artists', ['as'=>'artists.all', 'uses'=>'ArtistApiController@all']);
        Route::get('/artists/data', ['as'=>'artists.page.data', 'uses'=>'ArtistApiController@getIndexPageData']);
        Route::get('/artists/search', ['as'=>'artists.search', 'uses'=>'ArtistApiController@search']);
        Route::get('/artists/{id}', ['as'=>'artists.single', 'uses'=>'ArtistApiController@single']);

        //Category Page Internal Api ==> kind of (:)
        Route::get('/categories', ['as'=>'categories.all', 'uses'=>'CategoryApiController@all']);
        Route::post('/categories', ['as'=>'categories.create', 'uses'=>'CategoryApiController@store']);
        Route::get('/categories/{id}', ['as'=>'categories.single', 'uses'=>'CategoryApiController@single']);
        Route::delete('/categories/{id}', ['as'=>'categories.delete', 'uses'=>'CategoryApiController@delete']);
        Route::put('/categories/{id}', ['as'=>'categories.update', 'uses'=>'CategoryApiController@update']);

        //Users Page Internal Api ==> think so (:)
        Route::get('/users', ['as'=>'users.all', 'uses'=>'UsersApiController@all']);
        Route::get('/users/data', ['as'=>'users.data', 'uses'=>'UsersApiController@indexPageData']);
        Route::get('/users/{id}', ['as'=>'users.single', 'uses'=>'UsersApiController@single']);
        Route::put('/users/{id}', ['as'=>'users.update', 'uses'=>'UsersApiController@update']);
        Route::delete('/users/{id}', ['as'=>'users.delete', 'uses'=>'UsersApiController@delete']);

        //Ad page Internal Api ==> all hack (:)
        Route::get('/audio-ads', ['as'=>'audio.ads.all', 'uses'=>'AudioAdApiController@all']);
        Route::get('/audio-ads/data', ['as'=>'ad.page.data', 'uses'=>'AudioAdApiController@getIndexPageData']);
        Route::get('/audio-ads/{id}', ['as'=>'audio.ads.single', 'uses'=>'AudioAdApiController@single']);
        Route::post('/audio-ads', ['as'=>'audio.ads.create', 'uses'=>'AudioAdApiController@store']);
        Route::put('/audio-ads/{id}', ['as'=>'audio.ads.update', 'uses'=>'AudioAdApiController@update']);

        Route::get('/event-ads', ['as'=>'audio.ads.all', 'uses'=>'EventAdApiController@all']);
        Route::get('/event-ads/{id}', ['as'=>'audio.ads.single', 'uses'=>'EventAdApiController@single']);
        Route::put('/event-ads/{id}', ['as'=>'audio.ads.update', 'uses'=>'EventAdApiController@update']);
        Route::post('/event-ads', ['as'=>'audio.ads.create', 'uses'=>'EventAdApiController@store']);

        Route::get('/companies', ['as'=>'companies.all', 'uses'=>'CompanyApiController@all']);
        Route::post('/companies', ['as'=>'companies.create', 'uses'=>'CompanyApiController@store']);
        Route::get('/companies/{id}', ['as'=>'companies.single', 'uses'=>'CompanyApiController@single']);
        Route::put('/companies/{id}', ['as'=>'companies.update', 'uses'=>'CompanyApiController@update']);
        Route::delete('/companies/{id}', ['as'=>'companies.delete', 'uses'=>'CompanyApiController@delete']);

        //Admin Settings Page Internal Api really scary (:)
        Route::get('/staff', ['as'=>'staff.all', 'uses'=>'StaffApiController@all']);
        Route::get('/staff/{id}', ['as'=>'staff.single', 'uses'=>'StaffApiController@single']);
        Route::post('/staff', ['as'=>'staff.create', 'uses'=>'StaffApiController@store']);
        Route::put('/staff/{id}', ['as'=>'staff.update', 'uses'=>'StaffApiController@update']);
        Route::delete('/staff', ['as'=>'staff.delete', 'uses'=>'StaffApiController@delete']);

        Route::get('/roles', ['as'=>'role.all', 'uses'=>'RolesApiController@all']);
        Route::get('/roles/{id}', ['as'=>'role.single', 'uses'=>'RolesApiController@single']);
        Route::post('/roles', ['as'=>'role.create', 'uses'=>'RolesApiController@store']);
        Route::put('/roles/{id}', ['as'=>'role.update', 'uses'=>'RolesApiController@update']);
        Route::delete('/roles/{id}', ['as'=>'role.delete', 'uses'=>'RolesApiController@delete']);
    });
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    $api->post('register_first_step', ['as'=>'api.register_first', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@join']);
    $api->post('register_second_step', ['as'=>'api.register_second', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@register']);
    $api->post('login', ['as'=>'api.login', 'uses'=>'App\Http\Controllers\Auth\ApiAuthController@authenticate']);

    $api->group(['middleware'=>'api.auth'], function($api){

//        $api->get('categories', ['as'=>'api.categories', 'uses'=>'App\Http\Controllers\CategoriesController@index']);
//        $api->post('categories/{id}', ['as'=>'api.category.toggleFollow', 'uses'=>'App\Http\Controllers\CategoriesController@toggleFollow']);

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
