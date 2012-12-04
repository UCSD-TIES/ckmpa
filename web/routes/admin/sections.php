<?php
/*
 * All URLs are prefixed with /admin/sections
 * See index.php
 */
$sections = $app['controllers_factory'];

/*
 * No global list of sections, redirect to select a
 * primary location.
 */
$sections->match('/', function() use ($app){
	return $app->redirect('/admin/locations/');
});

/*************
 * Sections
 *************/
$sections->get('/{id}/', function ($id) use ($app){
	return '';
})->assert('id', '\d+');

$sections->match('/{id}/edit/', function($id) use ($app){

})->assert('id', '\d+');

$sections->match('/{id}/delete/', function($id) use ($app){
	return '';
})->assert('id', '\d+');

/*********************
 * Create Section
 * {id} references Location that the section belongs to.
 *********************/
$sections->match('/create/{id}', function($id) use ($app){
	return '';
})->assert('id', '\d+');

return $sections;