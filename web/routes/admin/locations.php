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
                /*if( !ctype_alnum($location_name) ) {
                  $errors['location_name'] = "Please use only letters and/or numbers for the location's name";
                }*/

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


return $routes;
