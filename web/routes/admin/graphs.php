<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;


$routes->get('/', function() use ($app){

	/* Get a list of volunteers. */
	$patrolTally = $app['paris']->getModel('Coastkeeper\PatrolTally')->find_many();
	));
	$tallyTotal = array(); 
	
	
	
	
	$tally = $request->get('tally');
	$patrolentryid = $request->get('coastkeeper_patrol_entry_id');
	$datasheetentryid = $request->get('coastkeeper_datasheet_entry_id');
	
	if ($tallyTotal[$patrolentryid] == null){
		$tallyTotal[$patrolentryid] = $tally;
	} else {
		$tallyTotal[$patrolentryid] = $tallyTotal[$patrolentryid] + $tally;
	}
	
	return $app['twig']->render('admin/volunteers/list.twig.html', array(
		'patrolTally' => $patrolTally
	));

})->before($admin_login_check)->bind('admin_volunteers');


return $routes;