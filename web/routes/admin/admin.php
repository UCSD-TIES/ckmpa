<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/**
 * All URLS will be prefixed with /admin/ automatically
 * by index.php
 **/

/* Get controller factory instance */
$admin = $app['controllers_factory'];

/*

	This function is used to verify
	that the user is logged in as
	and admin, otherwise, redirects to
	admin_login.

	Should be used with ->before() on all
	routes that need authentication.

 */
$admin_login_check = function() use ($app)
{
	/* Check session for user information */
	$user_array = $app['session']->get('admin_user');

	/* Check to make sure the user in session is an admin. */
	$user = $app['paris']->getModel('Coastkeeper\Volunteer')
		->where_equal('is_admin', 1)->find_one($user_array['id']);

	/* If the person isn't logged in, reroute to admin_login. */
	if(!$user_array || !$user)
	{
		return $app->redirect($app['url_generator']->generate('admin_login'));
	}

};

/*************
 * Index Page
 *************/
$admin->match('/', function(Request $request) use ($app){

	/* Show the index page. */
	return $app['twig']->render('admin/index.twig.html');

})->before($admin_login_check)->bind('admin_index');

/*
	Admin Login route.
*/
$admin->match('/login/', function(Request $request) use ($app){

	$errors = array();

	/* If we're trying to login */
	if( 'POST' == $request->getMethod() )
	{
		$username = $request->get('username');
		$password = $request->get('password');

		if(!$username)
		{
			$errors[] = "A username is required.";
		}

		if(!$password)
		{
			$errors[] = "A password is required.";
		}

		if(count($errors) <= 0)
		{
			$password = md5($password);

			$user = $app['paris']->getModel('Coastkeeper\Volunteer')
				->where_equal('is_admin',1)
				->where_equal('username', $username)
				->where_equal('password', $password)
				->find_one();

			/* If a user was found.. */
			if($user)
			{
				/* Set up the admin session */
				$adm = array(
					"id" => $user->id,
					"username" => $user->username
				);

				$app['session']->set('admin_user', $adm);

				/* Redirect to dashboard */
				return $app->redirect($app['url_generator']->generate('admin_index'));

			/* Otherwise error out. */
			}else{
				$errors[] = "Invalid username and password.";
			}

		}
	}

	/* Show the login form and any errors. */
	return $app['twig']->render('admin/login.twig.html', array(
		"errors" => $errors
	));

})->bind('admin_login');

/*
	Admin Logout route.
*/
$admin->get('/logout/', function() use ($app){

	/* Kill the session and rerout to login */
	$app['session']->invalidate();

	return $app->redirect($app['url_generator']->generate('admin_login'));

})->bind('admin_logout');


/*
	Return the instance of the Silex application.
*/
return $admin;