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

// Web routes
Route::group(['middleware' => 'web'], function () {
    Route::auth();
	Route::get('/', 'HomeController@index');
});

// Protected by role routes
Route::group(['middleware' => ['web', 'role:admin']], function () {
	Route::get('/projects/create', 'ProjectController@create');
	Route::get('/projects/{projectId}/edit', 'ProjectController@edit');
	Route::post('/projects', 'ProjectController@store');
	Route::post('/projects/{projectId}/edit', 'ProjectController@update');
	Route::get('/projects/{projectId}', 'ProjectController@show');
	
	Route::get('/projects/{projectId}/builds/{buildId}', 'BuildController@show');
	
	Route::get('/plist/{buildId}.plist', 'BuildController@generateIphonePlist');
});

// Disabled
/*
// API Access routes
Route::group(['prefix' => '/auth'], function () {
	Route::post('/authenticate', 'API\APIAuthController@authenticate');
	Route::get('/me', 'API\APIAuthController@getAuthenticatedUser');
});
*/

// RESTful API routes
Route::group(['prefix' => '/api/v1', 'middleware' => 'api'], function () {
	// Resources
	Route::any('/bounce', 'API\DebugController@bounceRequest');
	
	Route::resource('/builds', 'API\BuildController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::resource('/projects', 'API\ProjectController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('/projects.builds', 'API\ProjectBuildController', ['only' => ['index', 'show']]);
	Route::resource('/users', 'API\UserController', ['only' => ['index', 'show']]);
	
	// Additional relationships
	Route::get('/projects/{projectId}/head', 'API\ProjectBuildController@indexHead');
	Route::get('/builds/{buildId}/project', 'API\BuildController@getProject');
});
