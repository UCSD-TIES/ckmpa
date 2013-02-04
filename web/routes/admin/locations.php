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
	MPA (Locations) Management
 */
$routes->get('/', function() use ($app){

        /* Get a list of mpas */
        $locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

        /* Display the list of locations */
        return $app['twig']->render('admin/locations/list.twig.html', array(
            'locations' => $locations
        ));
        

})->before($admin_login_check)->bind('admin_locations');

$routes->match('/create/', function(Request $request) use ($app){

	/* Errors */
	$errors = array();

	if('POST' == $request->getMethod())
	{

		$first_name = $request->get('first_name');
		$last_name = $request->get('last_name');
		$username = $request->get('username');
		$is_admin = $request->get('is_admin');
		$password = $request->get('new_password');
		$passwordb = $request->get('new_password_b');

		/* Validity Checks. */

		/* First name must be letters and not blank. */
		if(empty($first_name) || !ctype_alpha($first_name))
		{
			$errors['first_name'] = "First name can only contain letters.";
		}

		/* Last name must be letters and not blank. */
		if(empty($last_name) || !ctype_alpha($last_name))
		{
			$errors['last_name'] = "Last name can only contain letters.";
		}

		/* Username must be alphanumeric */
		if(empty($username) || !ctype_alnum($username)){
			$errors['username'] = "Username must contain only letters or numbers.";
		}

		/* Passwords much match, not be blank, and at least 5 characters. */
		if(empty($password))
		{
			$errors['new_password'] = "Password cannot be blank.";
		}else if(strlen($password) < 5){
			$errors['new_password'] = "Password must be at least 5 characters.";
		}else if($password != $passwordb){
			$errors['new_password'] = "Passwords must match.";
		}

		/* check and fill "is_admin" */
		if(empty($is_admin) || !is_numeric($admin) || ($admin > 1))
		{
			$is_admin = 0;
		}

		/* Username must be unique */
		if($app['paris']->getModel('Coastkeeper\Volunteer')
						->where_equal('username', $username)
						->find_one())
		{

			$errors['username'] = "Username already in use.";

		}

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
	return $app['twig']->render('admin/locations/create.twig.html', array(
		"errors" => $errors,
	));

})->before($admin_login_check)->bind('admin_locations_create');


return $routes;
