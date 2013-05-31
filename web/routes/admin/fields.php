<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/fields/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

require_once __DIR__ . '/datasheet.php';
require_once __DIR__ . '/categories.php';

/* NOTE: $admin_login_check is defined in admin.php */

/*
	MPA (Locations) Management
 */
$routes->get('/{datasheet_id}/{category_id}/', function($datasheet_id, $category_id) use ($app){

        $data = array();

        $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
        $category = $datasheet->categories()->find_one($category_id);

        $fields = $category->entries()->find_many();
        

        /* Display the list of fields */
        return $app['twig']->render('admin/fields/list.twig.html', array(
            'datasheet' => $datasheet,
            'category' => $category,
            'fields' => $fields
        ));
        

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_fields_list');

// /*
//  * Display a specific location's sections
//  */
// $routes->get('/{datasheet_id}/{category_id}/', function($datasheet_id, $category_id) use ($app){

//     $datasheet = $app['paris']->getModel('Coastkeeper\Datasheet')->find_one($datasheet_id);
//     $category = $datasheet->categories()->find_one($category_id);

//     /* Get information on a certain location */
//     return $app['twig']->render('admin/fields/category_view.twig.html', array(
//         "category" => $category,
//         "fields" => $fields
//     )); 

// })->assert('id','\d+')
//   ->before($admin_login_check)
//   ->bind('admin_category_view');


$routes->match('/{datasheet_id}/{category_id}/create/', function(Request $request, $datasheet_id, $category_id) use ($app){

	/* Errors */
	$errors = array();

	if('POST' == $request->getMethod())
	{

		$category_name = $request->get('category_name');

		/* Validity Checks. */

            /* Location name cannot be blank */
            if( empty($category_name) )
            {
                    $errors['category_name'] = "Please enter an name for the new location";
            }

        /* Name must be unique */
        if( $app['paris']->getModel('Coastkeeper\Location')
                                      ->where_equal('name', $category_name)
                                      ->find_one()) {
          $errors['category_name'] = "There is already a location with that name";
        }

		/* If everything is ok, create the new location */
		if(count($errors) <= 0)
		{
			$category = $app['paris']->getModel('Coastkeeper\category')->create();
			$category->name = $category_name;
                        $category->coastkeeper_datasheet_id = 1;

			$category->save();

			return $app->redirect($app['url_generator']->generate('admin_locations'));
		}

	}

	/* Render the create form. */
	return $app['twig']->render('admin/fields/create.twig.html', array(
		"errors" => $errors,
	));

})->assert('datasheet_id', '\d+')
  ->assert('category_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_field_create');

// $routes->match( '/{id}/delete/', function( REQUEST $request, $id ) use ( $app ) {

//     /* get the location */
//     $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

//     if( 'POST' == $request->getMethod() && $location ) {

//         // check for delete approval
//         if( $request->get('approve_delete')) {

//             /* Delete the location */
//             $location->delete();

//             /* Return to the locations list */
//             return $app->redirect( $app['url_generator']->generate('admin_locations'));
//         }

//     }

//     /* display delete confirmation form */
//     return $app['twig']->render('admin/locations/delete.twig.html', array(
//         "location" => $location
//     ));

// })->assert('id','\d+')
//     ->before( $admin_login_check )
//     ->bind('admin_locations_delete');

// $routes->match( '/{id}/edit/', function( REQUEST $request, $id ) use ( $app ) {

//     /* Array for errors */
//     $errors = array();

//     /* get the location */
//     $location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

//     if( 'POST' == $request->getMethod() && $location ) {

//         /* Get the user input */
//         $location_name = $request->get('location_name');

//         /*
//          * Validity checks
//          */

//         /* Location name cannot be blank */
//         if( empty($location_name) )
//         {
//             $errors['location_name'] = "Please enter an name for the location";
//         }

//         /* Name must consist of letters and numbers */
//         if( !empty($location_name) && !ctype_alnum($location_name) ) {
//           $errors['location_name'] = "Please use only letters and/or numbers for the location's name";
//         }

//         /* Name must be unique */
//         if( $app['paris']->getModel('Coastkeeper\Location')
//                                       ->where_equal('name', $location_name)
//                                       ->find_one()) {
//             $errors['location_name'] = "There is already a location with that name";
//         }

//         /* If everything is ok, update the location */
//         if(count($errors) <= 0)
//         {
//             $location->name = $location_name;

//             /* Update the location */
//             $location->save();


//             $locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

//             return $app->redirect($app['url_generator']->generate('admin_locations'));
//         }
//     }

//     /* Render the edit locations form */
//     return $app['twig']->render('admin/locations/edit.twig.html', array(
//         "errors"   => $errors,
//         "location" => $location
//     ));

// })->assert('id', '\d+')
//  ->before($admin_login_check)
//  ->bind('admin_locations_edit');

return $routes;

function array_pshift(&$array) {
    $keys = array_keys($array);
    $key = array_shift($keys);
    $element = $array[$key];
    unset($array[$key]);
    return $element;
} 
