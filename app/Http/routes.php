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
Route::group(['middleware' => ['web', 'force.ssl']], function () {
    Route::auth();
	Route::get('/', 'HomeController@index');
});

// Protected by role routes
Route::group(['middleware' => ['web', 'role:admin', 'force.ssl']], function () {
	Route::resource('/projects', 'ProjectController', ['only' => ['index', 'show', 'store', 'edit', 'update', 'create']]);
	Route::get('/builds/{buildId}', 'BuildController@show');
	Route::get('/projects/{projectId}/builds/{buildId}', 'BuildController@nestedShow');
	Route::get('/downloads/builds/{buildId}', 'InstallLinkController@getAwsBuild');
});

// iOS doesn't hold session cookies for retrieving the plist
// TODO add url token verification
Route::group(['middleware' => ['force.ssl']], function () {
	Route::get('/downloads/plist/{buildId}.plist', 'InstallLinkController@getAwsPlist');
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
