<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

/*
 *  All URLS will be prefixed with /admin/sections/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/* NOTE: $admin_login_check is defined in admin.php */

/*
	View all sections
 */
$routes->get('/', function() use ($app){

        /* Get a list of mpas */
        $sections = $app['paris']->getModel('Coastkeeper\Section')->find_many();

        /* Display the list of locations */
        return $app['twig']->render('admin/sections/list.twig.html', array(
            'section' => $sections,
        ));
        
})->before($admin_login_check)->bind('admin_sections');

// /////////////// CREATE ROUTE ///////////////

// $routes->match('/create/', function(Request $request) use ($app){

// 	/* Errors */
// 	$errors = array();

// 	if('POST' == $request->getMethod())
// 	{

//           $section_name = $request->get('section_name');

//           /* Validity Checks. */

//           /* Section name cannot be blank */
//           if( empty($section_name) )
//           {
//             $errors['section_name'] = "Please enter an name for the new section";
//           }

//         /* Name must consist of letters and numbers */
//         if( !empty($section_name) && !ctype_alnum(str_replace(' ', '', $section_name) )) {
//           $errors['section_name'] = "Please use only letters and/or numbers for the section's name";
//         }

//           /* Name must be unique */
//           if( $app['paris']->getModel('Coastkeeper\Section')
//                                         ->where_equal('name', $section_name)
//                                         ->find_one()) {
//             $errors['section_name'] = "There is already a section with that name";
//           }

//           /* If everything is ok, create the new section */
//           if(count($errors) <= 0)
//           {
//             $section = $app['paris']->getModel('Coastkeeper\Section')->create();
//             $section->name = $section_name;
//             $section->coastkeeper_datasheet_id = 1;

//             $section->save();

//             $section = $app['paris']->getModel('Coastkeeper\Section')->find_many();

//             return $app->redirect($app['url_generator']->generate('admin_sections'));
//           }

// 	}

// 	/* Render the create form. */
// 	return $app['twig']->render('admin/sections/create.twig.html', array(
// 		"errors" => $errors
// 	));

// })->before($admin_login_check)->bind('admin_sections_create');


// ////////////////// DELETE ////////////////////
// $routes->match( '/{id}/delete/', function( REQUEST $request, $id ) use ( $app ) {

//     /* get the section */
//     $section = $app['paris']->getModel('Coastkeeper\Section')->find_one($id);

//     if( 'POST' == $request->getMethod() && $section ) {

//         // check for delete approval
//         if( $request->get('approve_delete')) {

//             /* Delete the section */
//             $section->delete();

//             /* Return to the sections list */
//             return $app->redirect( $app['url_generator']->generate('admin_sections'));
//         }

//     }

//     /* display delete confirmation form */
//     return $app['twig']->render('admin/locations/sections/delete.twig.html', array(
//         "section" => $section
//     ));

// })->assert('id','\d+')
//     ->before( $admin_login_check )
//     ->bind('admin_locations_sections_delete');


return $routes;
