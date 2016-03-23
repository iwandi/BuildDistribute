<?php

// TODO ADD ROLE PROTECTION IN CONTROLLERS

// Web routes
Route::group(['middleware' => ['web', 'force.ssl']], function () {
	// Entry
	Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
	
	// Auth Routes
	Route::get('/login', 'Auth\AuthController@getLogin');
	Route::get('/logout', 'Auth\AuthController@logout');
	Route::post('/login', 'Auth\AuthController@postLogin');
	Route::get('/register', 'Auth\AuthController@getRegister');
	Route::post('/register', 'Auth\AuthController@postRegister');
	
	// Password reset
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
});

// Web routes that require Auth
Route::group(['middleware' => ['web', 'auth', 'force.ssl']], function () {
	// Common
	Route::resource('/projects', 'ProjectController', ['only' => ['index', 'show', 'store', 'edit', 'update', 'create']]);
	Route::get('/builds/{buildId}', 'BuildController@show');
	Route::get('/projects/{projectId}/builds/{buildId}', 'BuildController@nestedShow');
	Route::get('/downloads/builds/{buildId}', 'InstallLinkController@getAwsBuild');
});

// Admin only routes
Route::group(['middleware' => ['web', 'auth', 'force.ssl']], function () {
	Route::get('/admin/users', 'AdminController@getUsers');
	Route::get('/admin/projects', 'AdminController@getProjects');
	Route::post('/admin/permissions/revoke', 'ProjectPermissionController@revokeAccess');
	Route::post('/admin/permissions/grant', 'ProjectPermissionController@grantAccess');
});

// iOS doesn't hold session cookies for retrieving the plist
// TODO add url token verification
Route::group(['middleware' => ['force.ssl']], function () {
	Route::get('/downloads/plist/{buildId}.plist', 'InstallLinkController@getAwsPlist');
});


// API Auth Disabled
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
