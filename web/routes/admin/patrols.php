<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;


/*
 *  All URLS will be prefixed with /admin/patrols/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/*
 * Route to display all patrols
 */
$routes->get('/', function() use ($app) {
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
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));
})->before($admin_login_check)
  ->bind('admin_patrols_all');

/*
 * Route to display patrols from a specific location, but all sections
 * Author: David Drabik - djdrabik@gmail.com
 */
$routes->get('/{location_id}/', function($location_id) use ($app) {
	$patrols = array();
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	if (!$location) {
		$app->abort(404, 'Section does not exist');
	}

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
	
	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));
})->assert('location_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols_one');

/*
 * Route to display patrols from the specific location and section
 * Author: David Drabik - djdrabik@gmail.com
 */
$routes->match('/{location_id}/{section_id}/', function($location_id, $section_id) use ($app) {

	$patrols = array();
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	if (!$location) {
		$app->abort(404, 'Section does not exist');
	}

	$section = $location->sections()->find_one($section_id);
	if (!$section) {
		$app->abort(404, 'Section does not exist');
	}

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
	
	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));

})->value('location_id', 0)
  ->value('section_id', 0)
  ->assert('location_id', '\d+')
  ->assert('section_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols');



return $routes;