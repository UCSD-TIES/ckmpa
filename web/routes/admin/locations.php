<?php
/*
 * All URLs prefixed with /admin/locations
 * See index.php
 */

$locations = $app['controllers_factory'];

/*************
 * Locations
 *************/
$locations->get('/', function () use ($app){
	
	/* Get list of locations */
	$locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

	return $app['twig']->render('admin/locations.twig', array(
			'locations' => $locations
	));
});

/******************
 * Create Location
 ******************/
$locations->match('/create/', function() use ($app){

	return '';

});

/****************
 * View Location
 ****************/
$locations->get('/{id}/', function($id) use ($app){

	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

	if(!$location)
	{
		$app->abort(404, "Location doesn't exist.");
	}

	return '';

})->assert('id', '\d+');

/*****************
 * Edit Location
 *****************/
$locations->match('/{id}/edit/', function($id) use ($app){

	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

	if(!$location)
	{
		$app->abort(404, "Location doesn't exist");
	}

	return '';

})->assert('id','\d+');

/*******************
 * Delete Location
 *******************/
$locations->match('/{id}/delete/', function($id) use ($app){

	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

	if(!$location)
	{
		$app->abort(404, "Location doesn't exist.");
	}

	return '';

})->assert('id','\d+');

return $locations;