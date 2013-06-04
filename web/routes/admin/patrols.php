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

	$patrols = $app['paris']->getModel('Coastkeeper\Patrol')->order_by_desc('date')->find_many();

	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));
})->before($admin_login_check)
  ->bind('admin_patrols_all');

$routes->get('/{location_id}/', function($location_id) use ($app) {
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	$patrols = $location->patrols()->find_many();

	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));

})->assert('location_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols_entries_locations_list');

/*
 * Route to display a patrols entries
 */
$routes->get('/{patrol_id}', function($patrol_id) use ($app) {

	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->find_one($patrol_id);

	$entries = $patrol->patrol_entries()->find_many();

	$volunteers = $app['paris']->getModel('Coastkeeper\Volunteer')->find_many();

	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/entries.twig.html', array(
		'patrol' => $patrol,
		'entries' => $entries,
		'volunteers' => $volunteers
	));
})->assert('patrol_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrol_entries_list');

/*
 * Route to display a patrols entries
 */
$routes->get('/{patrol_id}/{entry_id}', function($patrol_id, $entry_id) use ($app) {

	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->find_one($patrol_id);

	$entry = $patrol->patrol_entries()->find_one($entry_id);

	$tallies = $entry->patrol_tallies()->find_many();
	
	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/view.twig.html', array(
		'patrol' => $patrol,
		'entries' => $entry,
		'tallies' => $tallies,
		'location' => $patrol->location()->find_one()
	));
})->assert('patrol_id', '\d+')
  ->assert('entry_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrol_data_view');

return $routes;
