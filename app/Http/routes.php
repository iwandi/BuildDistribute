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
	// Route::get('/plist/{buildId}', 'BuildController@generatePlist');
});

// Protected by role routes
Route::group(['middleware' => ['web', 'role:admin']], function () {
	Route::get('/projects/create', 'ProjectController@create');
	Route::post('/projects', 'ProjectController@store');
	Route::get('/projects/{projectId}', 'ProjectController@show');
	Route::get('/projects/{projectId}/builds/{buildId}', 'BuildController@show');
	Route::get('/plist/{buildId}', 'BuildController@generateIphonePlist');
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
    Route::resource('/projects', 'API\ProjectController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('/projects.builds', 'API\ProjectBuildController', ['only' => ['index', 'show']]);
	Route::resource('/builds', 'API\BuildController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]); // ex. /builds?platform=ios&orderBy=revision&orderType=asc
	Route::resource('/users', 'API\UserController', ['only' => ['index', 'show']]);
	
	// Additional relationships
	Route::get('/projects/{projectId}/head', 'API\ProjectBuildController@indexHead'); // can also use query parameters ex. '/projects/123/head?platform=android'
	Route::get('/builds/{buildId}/project', 'API\BuildController@getProject');
});
