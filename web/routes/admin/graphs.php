<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/volunteers/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/* NOTE: $admin_login_check is defined in admin.php */

/*
	Volunteer Management
 */
$routes->get('/', function() use ($app){

	/* Get a list of volunteers. */
	$patrolTally = $app['paris']->getModel('Coastkeeper\PatrolTally')->find_many();
	));

})->before($admin_login_check)->bind('admin_volunteers');

$routes->match('/create/', function(Request $request) use ($app){

	$tallyTotal = array(); 

	if('POST' == $request->getMethod())
	{
		$tally = $request->get('tally');
		$patrolentryid = $request->get('coastkeeper_patrol_entry_id');
		$datasheetentryid = $request->get('coastkeeper_datasheet_entry_id');
		 
		 echo (print_r($volunteers));

		/* If everything is ok, create the new user*/
		if(count($errors) <= 0)
		{
			$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->create();
			$volunteer->first_name = $first_name;
			$volunteer->last_name = $last_name;
			$volunteer->username = $username;
			$volunteer->password = md5($password);
			$volunteer->is_admin = $is_admin;

			$volunteer->save();

			return $app->redirect($app['url_generator']->generate('admin_volunteer_view', array(
				"id"=>$volunteer->id
			)));
		}

	}

	/* Render the create form. */
	return $app['twig']->render('admin/volunteers/create.twig.html', array(
		"errors" => $errors,
	));

})->before($admin_login_check)->bind('admin_volunteer_create');

$routes->get('/{id}/', function($id) use ($app){

	/* Find the volunteer and send it to the template. */
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);

	/* Get information on a certain volunteer */
	return $app['twig']->render('admin/volunteers/view.twig.html', array(
		"volunteer" => $volunteer
	));

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_volunteer_view');

$routes->match('/{id}/edit/', function(Request $request, $id) use ($app){

	/* Array for errors */
	$errors = array();

	/* Find the volunteer */
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')
		->find_one($id);

	if('POST' == $request->getMethod() && $volunteer)
	{

		$first_name = $request->get('first_name');
		$last_name = $request->get('last_name');
		$username = $request->get('username');
		$password = $request->get('new_password');
		$passwordb = $request->get('new_password_b');
		$is_admin = $request->get('is_admin');

		
		/*
			If they didn't enter a first_name..
		 */
		if(empty($first_name) || !ctype_alpha($first_name))
		{
			$errors['first_name'] = "First name can only contain letters.";
		}

		/*
			If they didn't enter a last_name..
		 */
		if(empty($last_name) || !ctype_alpha($last_name))
		{
			$errors['last_name'] = "Last name can only contain letters.";
		}

		/*
			If they didn't enter a username, or if
			the username isn't alphanumberic
			[A-Z,a-z,0-9]
		 */
		if(empty($username) || !ctype_alnum($username))
		{
			$errors['username'] = "A username can only contain letters and numbers.";
		}

		/* 
			If we're changing the password, make sure
			that the password fields match.
			This is to make sure the password was typed
			correctly.
			A password must be at least 5 characters.
		 */
		if(!empty($password))
		{
			if($password != $passwordb){
				$errors['new_password'] = "Passwords entered do not match.";
			}

			if(strlen($password) < 5)
			{
				$errors['new_password'] = "Passwords must be at least 5 characters.";
			}
		}

		/* If is_admin isn't set, or is not a valid number */
		if(empty($is_admin) || !is_numeric($is_admin) || ($is_admin > 1))
		{
			$is_admin = 0;
		}

		/*
			If there are no errors, update the volunteer.
		 */
		if(count($errors) <= 0){
			$volunteer->first_name = $first_name;
			$volunteer->last_name = $last_name;
			$volunteer->username = $username;
			if(!empty($password))
			{
				$volunteer->password = md5($password);
			}
			$volunteer->is_admin = $is_admin;

			/* Save the new information */
			$volunteer->save();

			/* Redirect to volunteer page */
			return $app->redirect(
				$app['url_generator']->generate('admin_volunteer_view', array("id" => $id))
			);
		}
	}

	/* Render the edit volunteer form. */
	return $app['twig']->render('admin/volunteers/edit.twig.html', array(
		'volunteer' => $volunteer,
		'errors' => $errors
	));

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_volunteer_edit');

$routes->match('/{id}/delete/', function(Request $request, $id) use ($app){

	/* Get the volunteer */
	$volunteer = $app['paris']->getModel('Coastkeeper\Volunteer')->find_one($id);

	if('POST' == $request->getMethod() && $volunteer)
	{
		/* If the delete was approved. */
		if($request->get('approve_delete'))
		{
			/* Delete the volunteer and return to the volunteer list. */
			$volunteer->delete();

			return $app->redirect($app['url_generator']->generate('admin_volunteers'));
		}
	}

	/* display "are you sure" form. */
	return $app['twig']->render('admin/volunteers/delete.twig.html', array(
		"volunteer" => $volunteer
	));

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_volunteer_delete');

return $routes;