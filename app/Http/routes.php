<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pages/home');
});

Route::resource('project','ProjectController');
Route::resource('project.build','BuildController');

Route::get('project/{projectId}/head', 'BuildController@indexHead');
Route::get('project/{projectId}/{search}', 'BuildController@indexSearch');
Route::get('project/{projectId}/{platform}/head', 'BuildController@showPlatformHead');

Route::group(['prefix' => 'api/v1'], function() 
{
	Route::resource('build','BuildApiController',['only' => ['index', 'show', 'store', 'update', 'destroy']]);
});