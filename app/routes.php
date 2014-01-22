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
Route::get('/', "MobileController@getIndex");

Route::group(array('prefix' => 'mobile', 'before' => 'auth'), function()
{
	Route::any('/', array('as' => 'login', 'uses' => 'MobileController@getIndex'));
	Route::get('select-location', array('as' => 'select-location', 'uses' => 'MobileController@getSelectLocation'));
	Route::post('select-location', array('as' => 'select-location', 'uses' => 'MobileController@postSelectLocation'));
	Route::get('select-section/{id}', array('as' => 'select-section', 'uses' => 'MobileController@getSelectSection'));
	Route::get('data-collection/{id}', array('as' => 'get-data-collection', 'uses' => 'MobileController@getDataCollection'));
	Route::post('data-collection', array('as' => 'data-collection', 'uses' => 'MobileController@postDataCollection'));
	Route::get('finish', array('as' => 'finish', 'uses' => 'MobileController@finish'));
});
Route::controller('users', 'UsersController');

Route::get('admin/login', array('as' => 'admin-login', 'uses' => 'AdminController@getLogin'));
Route::post('admin/login', array('as' => 'admin-login', 'uses' => 'AdminController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
	Route::any('/', array('as' => 'index', 'uses' => 'AdminController@getIndex'));
	Route::get('logout', array('as' => 'logout', 'uses' => 'AdminController@getLogout'));
	Route::get('export-data/{id}/{sid?}', array('as' => 'export-data', 'uses' => 'AdminController@exportData'));

	//Resources
	Route::resource('volunteers', 'VolunteersController');
	Route::resource('patrols', 'PatrolsController');
	Route::resource('locations', 'LocationsController');
	Route::resource('sections', 'SectionsController');
	Route::resource('datasheets', 'DatasheetsController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('fields', 'FieldsController');

	//Patrols
	Route::get('patrols-entries-locations-list', array('as' => 'patrols-entries-locations-list', 'uses' => 'PatrolsController@patrolEntries'));
	Route::get('patrol-entries-list', array('as' => 'patrol-entries-list', 'uses' => 'PatrolsController@patrolEntries'));

	//Graphs
	Route::get('graphs', array('as' => 'graphs', 'uses' => 'AdminController@graphs'));
	Route::get('graphs-data', array('as' => 'graphs-data', 'uses' => 'AdminController@graphsData'));
	Route::get('graphs-observations', array('as' => 'graphs-observations', 'uses' => 'AdminController@graphsObservations'));
});
//Route::resource('users', 'UsersController');


