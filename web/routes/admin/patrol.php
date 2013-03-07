<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

$routes = $app['controllers_factory'];


$routes->match('/{id}/{patrolEntryID}/{patrol}/', function($id, $patrolEntryID,$patrol) use ($app){

	/* Find the volunteer and send it to the template. */
	$patrolEntry = $app['paris']->getModel('Coastkeeper\PatrolEntry')->find_one($patrolEntryID);
	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->find_one($patrol);
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);


	/* Get information on a certain patrol */
	return $app['twig']->render('admin/volunteers/patrol.twig.html', array(
		"patrol" => $patrol, 
		"patrolEntry" => $patrolEntry,
		"volunteer" => $volunteer,
	));

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_patrol_view');

return $routes;
