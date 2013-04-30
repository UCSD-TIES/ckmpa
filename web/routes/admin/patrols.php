<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpKernel\HttpKernelInterface;


/*
 *  All URLS will be prefixed with /admin/patrols/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/*
 * Route to display patrols
 *   - If no location ID is specified, displays patrols from all locations
 * 	 - If no section ID is specified, displays patrols from the specific location
 *   - Otherwise, displays patrols from specific location/section
 * Author: David Drabik - djdrabik@gmail.com
 */
$routes->get('/{location_id}/{section_id}', function($location_id, $section_id) use ($app) {

	$patrols = array();

	/* Get the location and section the user is requesting */
	if($location_id == 0) {
		$location = $app['paris']->getModel('Coastkeeper\Location')->find_many();	
	} else {
		$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
		if(!isset($location->id)) { $app->abort(404, "Location with that id does not exist"); }
	}

	/* Get the section the user is requesting */
	if($section_id == 0) {
		$section = $app['paris']->getModel('Coastkeeper\Section')->find_many();
	} else {
		$section = $app['paris']->getModel('Coastkeeper\Section')->find_one($section_id);
		if(!isset($section->id)) { $app->abort(404, "Section with that id does not exist"); }
	}

	/* Check whether the location/section combo is valid */
	if((!$location_id && !$section_id ) 
		&& !is_array($location) && !is_array($section)
		&& $location->id != $section->coastkeeper_location_id) {
		$app->abort(404, "Section doesn't exist at this MPA");
	}

	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
		'section' => $section,
		'location' => $location
	));

})->value('location_id', 0)
  ->value('section_id', 0)
  ->assert('location_id', '\d+')
  ->assert('section_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols');



return $routes;