<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/locations/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/* NOTE: $admin_login_check is defined in admin.php */

/*
	MPA (Locations) Management
 */
$routes->get('/', function() use ($app){

	$patrols = array();
	$locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();
	
	foreach ($locations as $location) {
		$sections = $location->sections()->find_many();

		foreach ($sections as $section) {
			$patrol_entries = $section->patrol_entry()->find_many();

			foreach ($patrol_entries as $patrol_entry) {
				$data = array();
				$patrol = $patrol_entry->patrol()->find_one();

				$volunteer = $patrol->volunteer()->find_one();

				if ($volunteer) {
					$data['volunteer'] = $volunteer->first_name . ' ' . $volunteer->last_name;
				}

				$data['location']  = $location;
				$data['section']   = $section;
				$data['date'] = $patrol->date;
				$data['finished'] = $patrol->finished;


				array_push($patrols, $data);
			}
		}
	}
        
    /* Render the html file, passing in the values */
	return $app['twig']->render('admin/graphs/create.twig.html', array(
		'graphs' => $patrols,
	));
        
})->before($admin_login_check)->bind('admin_graphs');

return $routes;
