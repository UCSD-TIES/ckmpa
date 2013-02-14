<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/* 
 * This is to display PHP errors to screen
 * it should be commented out when
 * in a production environment.
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/* */

/* get our application instance */
$app = require_once __DIR__ . '/../app/app.php';

/* enable debug mode */
$app['debug'] = true;

/*

	This function is used to check to make sure the user
	is logged in and should be
	->before($before)
	on all routes that require the user to be logged in.

 */
$login_check = function() use ($app){

	/* Check the user's session to see if they are logged in */
	$user = $app['session']->get('user');

	/* If they don't have a valid session, redirect them to login page. */
	if($user === null)
	{
		/* prevent infinite loop */
		if($app['request']->get('_route') != 'login'){
			return $app->redirect('/');
		}

	}

};

/*

	Index Page
	This is also the login page.
	Users that are not logged in will be redirected to this page.

 */
$app->match('/', function(Request $request) use ($app){
	
	/* Used to print out any errors with logging in. */
	$errors = array();

	/* If the user submitted the form. */
	if('POST' == $request->getMethod())
	{
		/* Get the login information from POST */
		$username = $request->get('username');
		$partner = $request->get('partner');

		/* Get the password and encrypt it with simple MD5 */
		$password = md5($request->get('password'));

		/* Verify that the user is able to login. */
		$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')
			->where_equal('username', $username)
			->where_equal('password', $password)
			->find_one();

		if(!$volunteer)
		{
			$errors[] = "Invalid Username or Password";
		}

		/* If a partner is set. */
		if(!empty($partner)){
			/* Verify that the partner exists. */
			$partner = $app['paris']->getModel('Coastkeeper\Volunteer')
				->where_equal('username', $partner)
				->find_one();

			if(!$partner)
			{
				$errors[] = "Partner doesn't exist.";
			}
		}

		/* Start a new patrol session. */
		if(count($errors) <= 0)
		{
			$app['session']->set('user', array(
				"id" => $volunteer->id,
				"username" => $volunteer->username
			));

			if($partner)
			{
				$app['session']->set('partner', array(
					"id" => $partner->id,
					"username" => $partner->username
				));
			}

			/* Redirect to start a patrol. */
			return $app->redirect($app['url_generator']->generate('patrol_location_select'));

		}

	}

	/* Show the login form, with any errors that might have occured. */
	return $app['twig']->render('index.twig.html', array('errors' => $errors));

})->bind('login');

/*
	User Logout.
*/
$app->match('/logout/', function() use ($app){

	/* user is logging out so invalidate current session */
	$app['session']->invalidate();

	/* Redirect to login page. */
	return $app->redirect($app['url_generator']->generate('login'));
})->bind('logout');

/*
	patrol_location_select
*/
$app->match('/patrol/location/', function(Request $request) use ($app){

	/* Error array for error display */
	$errors = array();

	/* If a location was selected. */
	if('POST' == $request->getMethod())
	{
		if(!$request->get('primary-location'))
		{
			$errors[] = "Please select a location.";
		}else{
			/* Get the ID and typecase to INT */
			$id = (int) $request->get('primary-location');

			/* Try and find the location */
			$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

			/* If it isn't a valid location, error out. */
			if(!$location)
			{
				$errors[] = "Selected location was not valid.";
			}else{
				/* if everything is ok, start a new Patrol*/
				$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->create();

				/* Set the owner of the patrol */
				$user = $app['session']->get('user');
				$patrol->coastkeeper_volunteer_id = $user['id'];
				/* if there is a partner, set the partner. */
				if($app['session']->get('partner'))
				{
					$partner = $app['session']->get('partner');
					$patrol->coastkeeper_partner_id = $partner['id'];
				}
				/* Set the location of the patrol */
				$patrol->coastkeeper_location_id = $id;

				/* Set the date of the current patrol */
				$patrol->date = date('Y-m-d');

				/* Set as current patrol */
				$patrol->finished = 0;

				/* Save the patrol */
				$patrol->save();

				/* Store the patrol id into session */
				$app['session']->set('patrol', $patrol->id);

				/* Redirect to Section selection */
				return $app->redirect($app['url_generator']->generate('patrol_section_select'));
			}
		}

	}

	/* Show a list of locations with valid datasheets */
	$locations = $app['paris']->getModel('Coastkeeper\Location')
		->where_not_null('coastkeeper_datasheet_id')->find_many();

	return $app['twig']->render('locations.twig.html', array(
		'locations' => $locations,
		'errors' => $errors
	));

})->before($login_check)->bind('patrol_location_select');

/*
	patrol_section_select
*/
$app->get('/patrol/section/', function() use ($app){

	/* errors */
	$errors = array();	

	/* Make sure there is currently a patrol. */
	$patrol_id = $app['session']->get('patrol');
	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')
		->find_one($patrol_id);

	/* if the patrol isn't found, redirect to start one. */
	if(!$patrol || !$patrol_id)
	{
		return $app->redirect($app['url_generator']->generate('patrol_location_select'));
	}

	/* Get the sections for the location of the patrol. */
	$sections = $patrol->location()->find_one()->sections()->find_many();

	/* Render the selection list. */
	return $app['twig']->render('sections.twig.html', array(
		'sections' => $sections,
		'errors' => $errors
	));

})->before($login_check)->bind('patrol_section_select');

$app->match('/patrol/section/{id}/', function(Request $request, $id) use ($app){

	/* Error stack */
	$errors = array();

	/* Make sure it's a valid section. */
	$section = $app['paris']->getModel('Coastkeeper\Section')->find_one($id);

	/* If it's not a valid section, redirect to section select. */
	if(!$section)
	{
		die("not a real section");
		return $app->redirect($app['url_generator']->generate('patrol_section_select'));
	}

	/* Make sure the current patrol is still valid */
	$patrol_id = $app['session']->get('patrol');
	$patrol = $app['paris']->getModel('Coastkeeper\Patrol')
		->where_equal('finished', 0)
		->find_one($patrol_id);

	/* If it's not a valid patrol, redirect to start a new one. */
	if(!$patrol)
	{
		die('no patrol set');
		return $app->redirect($app['url_generator']->generate('patrol_location_select'));
	}

	/* If the section isn't a part of the patrol, redirect to section select. */
	if($patrol->coastkeeper_location_id != $section->coastkeeper_location_id)
	{
		die('patrol isn\'t of that section');
		return $app->redirect($app['url_generator']->generate('patrol_section_select'));
	}

	/* If we've entered the start time. */
	if('POST' == $request->getMethod())
	{
		/* get the submitted start-time */
		$start = $request->get('start-time');

		/* Try converting it to a proper time. */
		$start = strtotime($start);

		/* If it fails, error out. */
		if(!$start)
		{
			$errors[] = "Please enter a time.";
		}

		/* If there are no errors at this point, proceed */
		if(count($errors) <= 0)
		{
			/* Start the patrol entry for the section. */

			/* Get the TIME string. */
			$start_time = date('H:i:s', $start);

			/* Create a new patrol. */
			$section_patrol = $app['paris']->getModel('Coastkeeper\PatrolEntry')->create();

			/* Set the proper ID's */
			$section_patrol->coastkeeper_patrol_id = $patrol->id;
			$section_patrol->coastkeeper_section_id = $section->id;

			/* Set the start time. */
			$section_patrol->start_time = $start_time;

			/* Save it. */
			$section_patrol->save();

			/* Set the current patrol into session */
			$app['session']->set('section_patrol', $section_patrol->id);

			/* Redirect to start the patrol form. */
			return $app->redirect($app['url_generator']->generate('patrol_datasheet'));
		}


	}

	/* render the start time selection */
	return $app['twig']->render('start.twig.html', array(
		"section" => $section,
		"errors" => $errors
	));

})->assert('id','\d+')->before($login_check)->bind('patrol_section_start');

$app->match('/patrol/datasheet/', function(Request $request) use ($app){

	/* Check to make sure there is a current patrol going on, otherwise redirect. */
	$section_patrol_id = $app['session']->get('section_patrol');
	$section_patrol = $app['paris']->getModel('Coastkeeper\PatrolEntry')->find_one($section_patrol_id);

	if(!$section_patrol || !$section_patrol_id)
	{
		return $app->redirect($app['url_generator']->generate('patrol_section_select'));
	}

	/* Get the datasheet. */
	$datasheet = $section_patrol
		->section()->find_one()
		->location()->find_one()
		->datasheet()->find_one();

	/* If there isn't a datasheet... well... */
	if(!$datasheet)
	{
		die("No datasheet available.");
	}

	/* if we're getting post information */
	if('POST' == $request->getMethod())
	{
		$categories = $datasheet->categories()->find_many();
		/* For each category, get the entries. */
		foreach( $categories as $category )
		{
			$entries = $category->entries()->find_many();
			/* For each entry, save the data. */
			foreach( $entries as $entry ){

				/* Create a new tally */
				$tally = $app['paris']->getModel('Coastkeeper\PatrolTally')->create();

				/* Link it to the patrol */
				$tally->coastkeeper_patrol_entry_id = $section_patrol->id;

				/* Link it to the datasheet entry */
				$tally->coastkeeper_datasheet_entry_id = $entry->id;

				/* Fill in the tally */
				$tally->tally = (int) $request->get('entry-' . $entry->id);

				/* Save the information */
				$tally->save();

			}
		}

		/* Redirect to Finish time. */
		return $app->redirect($app['url_generator']->generate('patrol_section_finish'));
	}

	/* Send the datasheet to render. */
	return $app['twig']->render('patrol.twig.html', array(
		'datasheet' => $datasheet,
	));

})->before($login_check)->bind('patrol_datasheet');

$app->match('/patrol/section/finish/', function(Request $request) use ($app){

	/* Errors */
	$errors = array();

	/* Make sure there's a section entry we're working with. */
	$section_patrol_id = $app['session']->get('section_patrol');
	$section_patrol = $app['paris']->getModel('Coastkeeper\PatrolEntry')->find_one($section_patrol_id);

	if(!$section_patrol || !$section_patrol_id)
	{
		/* redirect to section selection */
		return $app->redirect($app['url_generator']->generate('patrol_section_select'));
	}

	/* If we've entered the end time. */
	if('POST' == $request->getMethod())
	{
		/* Get the end time. */
		$end = $request->get('end-time');

		/* Parse the end time */
		$end = strtotime($end);

		/* If there is no proper end time... */
		if(!$end)
		{
			$errors[] = "Please enter an end time.";
		}

		/* If no errors occured */
		if(count($errors) <= 0)
		{
			/* Save the end time to the patrol. */
			$section_patrol->end_time = date('H:i:s', $end);

			/* Save changes. */
			$section_patrol->save();

			/* Remove it from the session. */
			$app['session']->remove('section_patrol');

			/* Redirect to Section select. */
			return $app->redirect($app['url_generator']->generate('patrol_section_select'));
		}

	}

	/* render the end-time form. */
	return $app['twig']->render('end.twig.html', array(
		"errors" => $errors
	));

})->before($login_check)->bind('patrol_section_finish');


$app->get('/patrol/finish/', function () use ($app){

	/* Find the current patrol. */
	$patrol_id = $app['session']->get('patrol');

	if($patrol_id)
	{
		$patrol = $app['paris']->getModel('Coastkeeper\Patrol')->find_one($patrol_id);

		/* If it exists, finish it. */
		if($patrol)
		{
			/* Set that the patrol is finished. */
			$patrol->finished = 1;

			/* Save and close the patrol. */
			$patrol->save();

			$app['session']->remove('patrol');
		}

	}

	/* return to location select */
	return $app->redirect($app['url_generator']->generate('patrol_location_select'));

})->before($login_check)->bind('patrol_finish');

/*
	Mount the Admin URLs
 */
$app->mount('/admin/', include __DIR__ . '/routes/admin/admin.php');
$app->mount('/admin/volunteers/', include __DIR__ . '/routes/admin/volunteers.php');
$app->mount('/admin/locations/', include __DIR__ . '/routes/admin/locations.php');

/*
	Run the application
*/
$app->run();

