<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;


/*
 *  All URLS will be prefixed with /admin/patrols/ automatically
 *  by admin.php
 */

$routes = $app['controllers_factory'];

/*
 * Route to display all patrols
 */
$routes->get('/', function() use ($app) {
	$patrols = array();
	$locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

	foreach ($locations as $location) {
		$sections = $location->sections()->find_many();

		foreach ($sections as $section) {
			$patrol_entries = $section->patrol_entry()->find_many();

			foreach ($patrol_entries as $patrol_entry) {
				$data = array();
				$patrol = $patrol_entry->patrol()->find_one();

				$volunteer = $patrol->volunteer()->find_one();

				if ($volunteer) {
					$data['volunteer'] = $volunteer->first_name . ' ' . $volunteer->last_name;
				}

				$data['id'] 	   = $patrol_entry->id;
				$data['location']  = $location;
				$data['section']   = $section;
				$data['date']      = $patrol->date;
				$data['finished']  = $patrol->finished;


				array_push($patrols, $data);
			}
		}
	}





	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
	));
})->before($admin_login_check)
  ->bind('admin_patrols_all');

/*
 * Route to display patrols from a specific location, but all sections
 * Author: David Drabik - djdrabik@gmail.com
 */
$routes->get('/{location_id}/', function($location_id) use ($app) {
	$patrols = array();
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	if (!$location) {
		$app->abort(404, 'Section does not exist');
	}

	$sections = $location->sections()->find_many();


	foreach ($sections as $section) {
		$patrol_entries = $section->patrol_entry()->find_many();


		foreach ($patrol_entries as $patrol_entry) {
			$data = array();
			$patrol = $patrol_entry->patrol()->find_one();

			$volunteer = $patrol->volunteer()->find_one();

			if ($volunteer) {
				$data['volunteer'] = $volunteer->first_name . ' ' . $volunteer->last_name;
			}

			$data['id'] 	   = $patrol_entry->id;
			$data['location']  = $location;
			$data['section']   = $section;
			$data['date']      = $patrol->date;
			$data['finished']  	= $patrol->finished;


			array_push($patrols, $data);
		}
	}
	
	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
                'location' => $location
	));
})->assert('location_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols_one');

/*
 * Route to display patrols from the specific location and section
 * Author: David Drabik - djdrabik@gmail.com
 */
$routes->match('/{location_id}/{section_id}/', function($location_id, $section_id) use ($app) {

	$patrols = array();
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	if (!$location) {
		$app->abort(404, 'Section does not exist');
	}

	$section = $location->sections()->find_one($section_id);
	if (!$section) {
		$app->abort(404, 'Section does not exist');
	}

	$patrol_entries = $section->patrol_entry()->find_many();

	foreach ($patrol_entries as $patrol_entry) {
		$data = array();
		$patrol = $patrol_entry->patrol()->find_one();

		$volunteer = $patrol->volunteer()->find_one();

		if ($volunteer) {
			$data['volunteer'] = $volunteer->first_name . ' ' . $volunteer->last_name;
		}

		$data['id'] 		= $patrol_entry->id;
		$data['location']  	= $location;
		$data['section']   	= $section;
		$data['date'] 		= $patrol->date;
		$data['finished'] 	= $patrol->finished;


		array_push($patrols, $data);
	}
	
	/* Render the html file, passing in the values */
	return $app['twig']->render('admin/patrols/list.twig.html', array(
		'patrols' => $patrols,
        'location' => $location,
        'section' => $section
	));

})->value('location_id', 1)
  ->value('section_id', 1)
  ->assert('location_id', '\d+')
  ->assert('section_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols');

$routes->match('{location_id}/{section_id}/{patrol_id}', function($location_id, $section_id, $patrol_id) use ($app) {

	$data = array();

	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($location_id);
	if (!$location) {
		$app->abort(404, 'Section does not exist');
	}

	$section = $location->sections()->find_one($section_id);
	if (!$section) {
		$app->abort(404, 'Section does not exist');
	}

	$datasheet = $location->datasheet()->find_one();
	$categories = $datasheet->categories()->find_many();

	$patrol_entry = $section->patrol_entry()->find_one($patrol_id);
	$patrol_tallies = $patrol_entry->patrol_tallies()->find_many();

        foreach ($patrol_tallies as $patrol_tally) {
          $category_array = array();
          $patrol_field_array = array();

          $patrol_field = $patrol_tally->datasheet_entry()->find_one();
          $category = $patrol_field->datasheet_category()->find_one();

          $arr["category_id"] = $category->id;
          $arr["field"] = $patrol_field->name;
          $arr["tally"] = $patrol_tally->tally;

          array_push($data, $arr);
        }


	return $app['twig']->render('admin/patrols/view.twig.html', array(
		'location'   => $location,
		'section'    => $section,
                'categories' => $categories,
                'patrol'     => $patrol_entry,
		'tallies'    => $data
	));

})->assert('location_id', '\d+')
  ->assert('section_id', '\d+')
  ->assert('patrol_id', '\d+')
  ->before($admin_login_check)
  ->bind('admin_patrols_view');



return $routes;
