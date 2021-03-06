<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function() {
	return File::get(public_path()."/index.html");
});

// Confide User routes
Route::group(array('prefix' => 'users'), function ()
{
	Route::get('login', array('as' => 'user-login', 'uses' => 'UsersController@login'));
	Route::post('login', array('as' => 'user-login', 'uses' => 'UsersController@do_login'));
	Route::get('register', array('as' => 'register', 'uses' => 'UsersController@register'));
	Route::post('', array('as' => 'register', 'uses' => 'UsersController@store'));
	Route::get('confirm/{code}', array('as' => 'confirm-password', 'uses' => 'UsersController@confirm'));
	Route::get('forgot_password', array('as' => 'forgot_password', 'uses' => 'UsersController@forgot_password'));
	Route::post('forgot_password', array('as' => 'forgot_password', 'uses' => 'UsersController@do_forgot_password'));
	Route::get('reset_password/{token}', array('as' => 'reset_password', 'uses' => 'UsersController@reset_password'));
	Route::post('reset_password', array('as' => 'reset_password', 'uses' => 'UsersController@do_reset_password'));
	Route::get('logout', array('as' => 'register', 'uses' => 'UsersController@logout'));
});

// Admin routes
Route::get('admin/login', array('as' => 'admin-login', 'uses' => 'AdminController@getLogin'));
Route::post('admin/login', array('as' => 'admin-login', 'uses' => 'AdminController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function ()
{
	Route::any('/', array('as' => 'index', 'uses' => 'AdminController@getIndex'));
	Route::get('logout', array('as' => 'logout', 'uses' => 'AdminController@getLogout'));
	Route::get('export-data/{id}/{sid?}', array('as' => 'export-data', 'uses' => 'AdminController@exportData'));

	//Resources
	Route::resource('volunteers', 'VolunteersController');
	Route::resource('patrols', 'PatrolsController');
	Route::resource('mpas', 'MpasController');
	Route::resource('transects', 'TransectsController');
	Route::resource('datasheets', 'DatasheetsController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('fields', 'FieldsController');
	Route::resource('subs', 'SubsController');

	Route::get('patrol-pdf/{id}', 'TransectsController@getPDF');

    Route::get('delete-option/{id}', 'FieldsController@deleteOption');
	Route::get('add-option/{id}', 'FieldsController@addOption');

	Route::get('search-user', 'VolunteersController@search');
	Route::post('confirm-user', 'VolunteersController@confirm');

	//Patrols
    Route::get('patrol-list/{mpa?}/{transect?}', array('as' => 'patrol-list', 'uses' => 'PatrolsController@patrolsList'));
	Route::get('patrol-user/{user?}', array('as' => 'patrol-user', 'uses' => 'PatrolsController@patrolsUser'));
    Route::get('patrol-tallies/{patrol}', array('as' => 'patrol-tallies', 'uses' => 'PatrolsController@patrolTallies'));

	//Graphs
	Route::get('graphs', array('as' => 'graphs', 'uses' => 'AdminController@graphs'));
	Route::get('graphs-data', array('as' => 'graphs-data', 'uses' => 'AdminController@graphsData'));
	Route::get('graphs-observations', array('as' => 'graphs-observations', 'uses' => 'AdminController@graphsObservations'));
});

Route::group(array('prefix' => 'api'), function ()
{
	Route::group(array('before' => 'auth.token'), function() {
		Route::controller('mpas', 'APIMpas');
		Route::controller('datasheets', 'APIDatasheets');
		Route::controller('patrols', 'APIPatrols');
	});

	Route::controller('users', 'APIUsers');

	// Auth Token Routes
	Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
	Route::post('auth', 'Tappleby\AuthToken\AuthTokenController@store');
	Route::delete('auth', 'Tappleby\AuthToken\AuthTokenController@destroy');
});


// Password Reminder Routes
Route::controller('password', 'RemindersController');


