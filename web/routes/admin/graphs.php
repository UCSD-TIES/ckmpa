<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/graphs/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/* NOTE: $admin_login_check is defined in admin.php */

/*
	MPA (Locations) Management
 */
$routes->get('/', function(Request $request) use ($app){

	$datasheets = $app['paris']->getModel('Coastkeeper\Datasheet')->find_many();


    /* Render the html file, passing in the values */
	return $app['twig']->render('admin/graphs/create.twig.html', array(
		'datasheets' => $datasheets
	));
        
})->before($admin_login_check)->bind('admin_graphs');

$routes->get('/data', function(Request $request) use ($app) {

	$startYear = $app['request']->get('startYear');
	$startMonth = $app['request']->get('startMonth');
	$startDay = $app['request']->get('startDay');

	$endYear = $app['request']->get('endYear');
	$endMonth = $app['request']->get('endMonth');
	$endDay = $app['request']->get('endDay');

	$datasheet_id = $app['request']->get('datasheet');

	$datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);

	$locations = $datasheet->locations()->find_many();

	$data = array();
	foreach ($locations as $location) {
		$sections = $location->sections()->find_many();

		foreach($sections as $section) {
			$patrol_entries = $section->patrol_entry()->find_many();

			/* For each patrol entry, fill out a row */
			foreach($patrol_entries as $patrol_entry) {

				/* Get the parent patrol. */
				$patrol = $patrol_entry->patrol()->find_one();

				/* Now get all the tallies for this patrol... */
				$tallies = $patrol_entry->patrol_tallies()->find_many();

				foreach($tallies as $tally) {
					if ($tally->tally === "1") {
						if (array_key_exists($tally->coastkeeper_datasheet_entry_id, $data)) {
							$data[$tally->coastkeeper_datasheet_entry_id] += 1;
						} else {
							$data[$tally->coastkeeper_datasheet_entry_id] = 1;
						}
					}
				}
			}
		}
	}

	// echo '<pre>';
	// var_dump($data);
	// echo '</pre>';

	return $app->json($data, 201);
})->before($admin_login_check)->bind('admin_graphs_data');


return $routes;
