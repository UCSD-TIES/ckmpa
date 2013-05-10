<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

$routes = $app['controllers_factory'];


$routes->match('/{id}/{patrolEntryID}/{patrol}/{lid}/', function($id, $patrolEntryID,$patrol,$lid) use ($app){

	/* Find the patrol and it's entries and send it to the template. */

	$patrolEntries = $app['paris']->getModel('Coastkeeper\PatrolEntry')->find_many();
	$ourPatrolEntries = array();
	foreach($patrolEntries as $patrolEntry){
		if( $patrolEntry->coastkeeper_patrol_id == $patrolEntryID){
			array_push($ourPatrolEntries, $patrolEntry);
		}
	}
	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->find_one($patrol);
	
	/* Find the volunteer, sections, and loction to send to the template */
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($lid);
	$sections = array();
	foreach($ourPatrolEntries as $patrolEntry){
		$sid = $patrolEntry->coastkeeper_section_id;
		array_push( $sections, $app['paris']->getModel('Coastkeeper\Section')->find_one($sid));
	}

	/* Find all the patrol tallies and their dataEntries */
	$dataEntries = array();
	$patrolTallies = $app['paris']->getModel('Coastkeeper\PatrolTally')->find_many();
	for( $i = 0; $i < count($patrolTallies); ++$i) {
		if ( $patrolTallies[$i]->coastkeeper_patrol_entry_id == $patrolEntryID){
			$deid = $patrolTallies[$i]->coastkeeper_datasheet_entry_id;
			$dataEntries[$i] = $app['paris']->getModel('Coastkeeper\DatasheetEntry')->find_one($deid);
		}
	}


	/* Pass the categories in */
	$categories = $app['paris']->getModel('Coastkeeper\DatasheetCategory')->find_many();


	/* Get information on a certain patrol */
	/* Pass all the variables to the template */
	return $app['twig']->render('admin/volunteers/patrol.twig.html', array(
		"patrol" => $patrol, 
		"patrolEntries" => $ourPatrolEntries,
		"volunteer" => $volunteer,
		"location" => $location,
		"sections" => $sections,
		"patrolTallies" => $patrolTallies,
		"dataEntries" => $dataEntries,
		"patrolEntryID" => $patrolEntryID,
		"categories" => $categories
	));

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_patrol_view');

return $routes;
