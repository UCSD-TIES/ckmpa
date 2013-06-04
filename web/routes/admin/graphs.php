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
	return $app['twig']->render('admin/graphs/view.twig.html', array(
		'datasheets' => $datasheets
	));
        
})->before($admin_login_check)->bind('admin_graphs');

$routes->get('/data', function(Request $request) use ($app) {

	$messages = array();

	$startDate = $app['request']->get('startDate');
	$endDate = $app['request']->get('endDate');

	$startDate = DateTime::createFromFormat('m/d/Y', $startDate);
	$endDate = DateTime::createFromFormat('m/d/Y', $endDate);

	$finishedPatrols = $app['request']->get('completePatrol');

	$datasheet_id = $app['request']->get('datasheet');

	if (!$datasheet_id) {
		$messages['errors'] = "Please select a datasheet";
	}

	if (count($messages) <= 0) {
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

					/* 
					 * If the finished Patrol filter is on,
					 * ignore any patrols that arent finished
					 */
					if ($finishedPatrols && !$patrol->finished) {
						continue;
					}

					/*
					 * Filter out any patrols not in between the given dates
					 */
					if ($startDate && $endDate) {

						$patrolDate = DateTime::createFromFormat('Y-m-d', $patrol->date);

						if( ($patrolDate < $startDate) || ($patrolDate > $endDate) ) {
							continue;
						}
					}

					/* Now get all the tallies for this patrol... */
					$tallies = $patrol_entry->patrol_tallies()->find_many();

					foreach($tallies as $tally) {
						if ($tally->tally === "1") {

							$datasheet_entry = $tally->datasheet_entry()->find_one();

							if (array_key_exists($datasheet_entry->name , $data)) {
								$data[$datasheet_entry->name ] += 1;
							} else {
								$data[$datasheet_entry->name ] = 1;
							}
						}
					}
				}
			}
		}

		return $app->json($data, 201);
	}

	return $app->json($messages, 201);

	// echo '<pre>';
	// var_dump($data);
	// echo '</pre>';


})->before($admin_login_check)->bind('admin_graphs_data');

$routes->get('/observations', function(Request $request) use ($app) {

	$messages = array();

	$startDate = $app['request']->get('startDate');
	$endDate = $app['request']->get('endDate');

	$startDate = DateTime::createFromFormat('m/d/Y', $startDate);
	$endDate = DateTime::createFromFormat('m/d/Y', $endDate);

	$finishedPatrols = $app['request']->get('completePatrol');

	$datasheet_id = $app['request']->get('datasheet');

	if (!$datasheet_id) {
		$messages['errors'] = "Please select a datasheet";
	}

	if (count($messages) <= 0) {
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

					/* 
					 * If the finished Patrol filter is on,
					 * ignore any patrols that arent finished
					 */
					if ($finishedPatrols && !$patrol->finished) {
						continue;
					}

					/*
					 * Filter out any patrols not in between the given dates
					 */
					$patrolDate = DateTime::createFromFormat('Y-m-d', $patrol->date);
					if ($startDate && $endDate) {
						if( ($patrolDate < $startDate) || ($patrolDate > $endDate) ) {
							continue;
						}
					}

					if(!array_key_exists($patrolDate->format('M Y'), $data)) {
						$data[$patrolDate->format('M Y')] = array();
					}
					
					if(!array_key_exists('patrols', $data[$patrolDate->format('M Y')])) {
						$data[$patrolDate->format('M Y')]['patrols'] = 1;
					} else {
						$data[$patrolDate->format('M Y')]['patrols'] += 1;
					}

					/* Now get all the tallies for this patrol... */
					$tallies = $patrol_entry->patrol_tallies()->find_many();


					foreach($tallies as $tally) {
						if(!array_key_exists('observations', $data[$patrolDate->format('M Y')])) {
							$data[$patrolDate->format('M Y')]['observations'] = 1;
						} else {
							$data[$patrolDate->format('M Y')]['observations'] += 1;
						}
					}
				}
			}
		}

		return $app->json($data, 201);
	}

	return $app->json($messages, 201);

	// echo '<pre>';
	// var_dump($data);
	// echo '</pre>';


})->before($admin_login_check)->bind('admin_graphs_observations');



return $routes;
