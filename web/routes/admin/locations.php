<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/locations/ automatically
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

		$location_name = $request->get('location_name');

		/* Validity Checks. */

            /* Location name cannot be blank */
            if( empty($location_name) )
            {
                    $errors['location_name'] = "Please enter an name for the new location";
            }

        /* Name must consist of letters and numbers */
        if( !empty($location_name) && !ctype_alnum($location_name) ) {
          $errors['location_name'] = "Please use only letters and/or numbers for the location's name";
        }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Location')
                                      ->where_equal('name', $location_name)
                                      ->find_one()) {
          $errors['location_name'] = "There is already a location with that name";
        }

		/* If everything is ok, create the new location */
		if(count($errors) <= 0)
		{
			$location = $app['paris']->getModel('Coastkeeper\Location')->create();
			$location->name = $location_name;
                        $location->coastkeeper_datasheet_id = 1;

			$location->save();

            $locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

			return $app->redirect($app['url_generator']->generate('admin_locations'));
		}

	}

	/* Render the create form. */
	return $app['twig']->render('admin/locations/create.twig.html', array(
		"errors" => $errors,
	));

})->before($admin_login_check)->bind('admin_locations_create');

$routes->match( '/{id}/delete/', function( REQUEST $request, $id ) use ( $app ) {

    /* get the location */
    $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

    if( 'POST' == $request->getMethod() && $location ) {

        // check for delete approval
        if( $request->get('approve_delete')) {

            /* Delete the location */
            $location->delete();

            /* Return to the locations list */
            return $app->redirect( $app['url_generator']->generate('admin_locations'));
        }

    }

    /* display delete confirmation form */
    return $app['twig']->render('admin/locations/delete.twig.html', array(
        "location" => $location
    ));

})->assert('id','\d+')
    ->before( $admin_login_check )
    ->bind('admin_locations_delete');

$routes->match( '/{id}/edit/', function( REQUEST $request, $id ) use ( $app ) {

    /* Array for errors */
    $errors = array();

    /* get the location */
    $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

    if( 'POST' == $request->getMethod() && $location ) {

        /* Get the user input */
        $location_name = $request->get('location_name');

        /*
         * Validity checks
         */

        /* Location name cannot be blank */
        if( empty($location_name) )
        {
            $errors['location_name'] = "Please enter an name for the location";
        }

        /* Name must consist of letters and numbers */
        if( !empty($location_name) && !ctype_alnum($location_name) ) {
          $errors['location_name'] = "Please use only letters and/or numbers for the location's name";
        }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Location')
                                      ->where_equal('name', $location_name)
                                      ->find_one()) {
            $errors['location_name'] = "There is already a location with that name";
        }

        /* If everything is ok, update the location */
        if(count($errors) <= 0)
        {
            $location->name = $location_name;

            /* Update the location */
            $location->save();


            $locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

            return $app->redirect($app['url_generator']->generate('admin_locations'));
        }
    }

    /* Render the edit locations form */
    return $app['twig']->render('admin/locations/edit.twig.html', array(
        "errors"   => $errors,
        "location" => $location
    ));

})->assert('id', '\d+')
 ->before($admin_login_check)
 ->bind('admin_locations_edit');


///////// VIEW A LOCATION'S Sections //////////////////

$routes->get('/{id}/', function($id) use ($app){

    /* Find the sections with the same coastkeeper_location_id and send it to the template. */
    $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

    $section = $app['paris']->getModel('Coastkeeper\Section')
        ->where_equal('coastkeeper_location_id', $id)
        ->find_many();

    /* Get information on a certain location */
    return $app['twig']->render('admin/locations/view.twig.html', array(
        "section" => $section,
        "location" => $location
    )); 

})->assert('id','\d+')
  ->before($admin_login_check)
  ->bind('admin_locations_view');

/////////////// CREATE Section ROUTE ///////////////

$routes->match('{id}/section_create/', function(Request $request, $id) use ($app){

    /* Errors */
    $errors = array();

    $section = $app['paris']->getModel('Coastkeeper\Section')->find_many();

    $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

    if('POST' == $request->getMethod())
    {

        $section_name = $request->get('section_name');

        /* Validity Checks. */

            /* Section name cannot be blank */
            if( empty($section_name) )
            {
                    $errors['section_name'] = "Please enter an name for the new section";
            }

        /* Name must consist of letters and numbers */
        if( !empty($section_name) && !ctype_alnum($section_name) ) {
          $errors['section_name'] = "Please use only letters and/or numbers for the section's name";
        }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Section')
                        ->where_equal('name', $section_name)
                        ->find_one()) {
          $errors['section_name'] = "There is already a section with that name";
        }

        /* If everything is ok, create the new section */
        if(count($errors) <= 0)
        {
            $section = $app['paris']->getModel('Coastkeeper\Section')->create();
            $section->name = $section_name;
            $section->coastkeeper_location_id = $id;

            $section->save();

            $section = $app['paris']->getModel('Coastkeeper\Section')->find_many();

            return $app->redirect($app['url_generator']->generate('admin_locations_view', array("id" => $id)));
        }

    }

    /* Render the create form. */
    return $app['twig']->render('admin/locations/sections/section_create.twig.html', array(
        "errors" => $errors,
        "section" => $section,
        "location" => $location
    ));

})->assert('id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_sections_create');


/////////////// DELETE section ROUTE /////////////
$routes->match( '/{id}/section_delete/', function( REQUEST $request, $id ) use ( $app ) {

    /* get the section */
    $section = $app['paris']->getModel('Coastkeeper\Section')->find_one($id);

    if( 'POST' == $request->getMethod() && $section ) {

        // check for delete approval
        if( $request->get('approve_delete')) {

            /* Delete the location */
            $section->delete();

            /* Return to the locations list */
            return $app->redirect( $app['url_generator']->generate('admin_locations_view'));
        }

    }

    /* display delete confirmation form */
    return $app['twig']->render('admin/locations/sections/section_delete.twig.html', array(
        "section" => $section
    ));

})->assert('id','\d+')
    ->before( $admin_login_check )
    ->bind('admin_sections_delete');

return $routes;
