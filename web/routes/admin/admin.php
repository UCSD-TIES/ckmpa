<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use \PHPExcel;

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
        $app['session']->set('admin_user', null);
	$app['session']->invalidate();

	return $app->redirect($app['url_generator']->generate('admin_login'));

})->bind('admin_logout');

/*

	TEMPORARY EXPORT FEATURE FOR VISUALIZING THE DATA THROUGH
	EXCEL, THIS SHOULD BE REPLACED TO HAVE THE ADMIN PANEL
	DO ALL THE FANCY THINGS.

 */
$admin->get('/export/', function() use($app){

	/* List datasheets for export */
	$locations = $app['paris']->getModel('Coastkeeper\Location')->find_many();

	return $app['twig']->render('admin/export/list.twig.html', array(
		"locations" => $locations
	));

})->before($admin_login_check)->bind('admin_export');

$admin->get('/export/{id}/', function($id) use ($app){

	/* Set up the Top row for the sheet. */
	$sheet_header = array();
	$sheet_header["A"] = "Date";
	$sheet_header["B"] = "Volunteer 1";
	$sheet_header["C"] = "Volunteer 2";
	$sheet_header["D"] = "Start Time";
	$sheet_header["E"] = "End Time";
	$sheet_header_prefix = '';
	$sheet_header_start_pos = ord('F');
	$sheet_header_start_index = 0;

	/* This will hold where the Entry is in the "Sheet_header" array */
	$entries_position = array();

	/* Get the location */
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($id);

	$filename = $location->name . '-' . date('Y-m-d');

	/* Get the datasheet, we'll need to set the header up */
	$datasheet = $location->datasheet()->find_one();

	/* We're going to need to all the Entries for the datasheet as well. */
	$datasheet_categories = $datasheet->categories()->find_many();
	/* Step through the categories to get the entires. */
	foreach($datasheet_categories as $category)
	{
		$entries = $category->entries()->find_many();

		/* Step through each entry and add them to the entries array. */
		foreach($entries as $entry){
			/* Get the next column */
			$column = $sheet_header_prefix . chr($sheet_header_start_pos + $sheet_header_start_index);
			/* Add it to the sheet header */
			$sheet_header[$column] = $entry->name;
			/* Add this position to the entries_position array */
			$entries_position[$entry->id] = $column;
			/* Increase the index */
			$sheet_header_start_index++;
			/* If we've reached Z, we need to start doing Prefixes. */
			if(($sheet_header_start_pos + $sheet_header_start_index) >= ord('Z'))
			{
				if($sheet_header_prefix == ''){
					$sheet_header_prefix = 'A';
				}else{
					$sheet_header_prefix = ord($sheet_header_prefix);
					$sheet_header_prefix++;
					$sheet_header_prefix = chr($sheet_header_prefix);
				}
				$sheet_header_start_pos = ord('A');
				$sheet_header_start_index = 0;
			}
		}

	}

	/* 
		We now have our header row that we can use to'
		populate an excel sheet.
	*/

	/* Create a new excel object. */
	$excel = new PHPExcel();

	/*
		Lets get all the sections of the location.
	*/
	$sections = $location->sections()->find_many();

	/* For each section, lets make a sheet */
	foreach($sections as $section)
	{
		/* Set the current sheet */
		$sheet = $excel->createSheet();

		/* Set the worksheet title */
		$sheet->setTitle(substr(preg_replace("/[^A-Za-z0-9]/","",$section->name), 0, 31));

		/* The current row we're working with */
		$row_index = 1;

		/* Fill in our headers. */
		foreach($sheet_header as $key => $value)
		{
			$sheet->setCellValue($key . $row_index, $value);
		}

		$row_index++;

		/* Get all of the PatrolEntries for this section */
		$patrol_entries = $section->patrol_entry()->find_many();

		/* For each patrol entry, fill out a row */
		foreach($patrol_entries as $patrol_entry)
		{
			/* Get the parent patrol. */
			$patrol = $patrol_entry->patrol()->find_one();

			/* Set the date */
			$sheet->setCellValue('A' . $row_index, $patrol->date);

			/* Get Volunteer information */
			$volunteer = $patrol->volunteer()->find_one();

			/* Set the values */
			if ($volunteer) {
				$sheet->setCellValue('B' . $row_index, $volunteer->first_name . ' ' . $volunteer->last_name);
			}
			if($patrol->coastkeeper_partner_id){
				$partner = $app['paris']->getModel('Coastkeeper\Volunteer')
									->find_one($patrol->coastkeeper_partner_id);
				$sheet->setCellValue('C' . $row_index, $partner->first_name . ' ' . $partner->last_name);
			}

			/* Set the start time and end time */
			$sheet->setCellValue('D' . $row_index , $patrol_entry->start_time);
			$sheet->setCellValue('E' . $row_index , $patrol_entry->end_time);

			/* Now get all the tallies for this patrol... */
			$tallies = $patrol_entry->patrol_tallies()->find_many();

			foreach($tallies as $tally)
			{
				$sheet->setCellValue($entries_position[$tally->coastkeeper_datasheet_entry_id] . $row_index, $tally->tally);
			}

			/* increase the row */
			$row_index++;

		}
	}

	/* Remove the cover Sheet */
	$excel->removeSheetByIndex(0);

	/* Set the header values. */
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename.xls\"");
	header("Cache-control: max-age=0");

	/* Write the information */
	$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
	$writer->save("php://output");

	/* exit, as we don't need silex to do anything */
	exit;

})->assert('id','\d+')->before($admin_login_check)->bind('admin_export_data');


$admin->get('/export/{lid}/{sid}', function($lid, $sid) use ($app){

	/* Set up the Top row for the sheet. */
	$sheet_header = array();
	$sheet_header["A"] = "Date";
	$sheet_header["B"] = "Volunteer 1";
	$sheet_header["C"] = "Volunteer 2";
	$sheet_header["D"] = "Start Time";
	$sheet_header["E"] = "End Time";
	$sheet_header_prefix = '';
	$sheet_header_start_pos = ord('F');
	$sheet_header_start_index = 0;

	/* This will hold where the Entry is in the "Sheet_header" array */
	$entries_position = array();

	/* Get the location */
	$location = $app['paris']->getModel('Coastkeeper\Location')->find_one($lid);

	/* Get the datasheet, we'll need to set the header up */
	$datasheet = $location->datasheet()->find_one();

	/* We're going to need to all the Entries for the datasheet as well. */
	$datasheet_categories = $datasheet->categories()->find_many();
	/* Step through the categories to get the entires. */
	foreach($datasheet_categories as $category)
	{
		$entries = $category->entries()->find_many();

		/* Step through each entry and add them to the entries array. */
		foreach($entries as $entry){
			/* Get the next column */
			$column = $sheet_header_prefix . chr($sheet_header_start_pos + $sheet_header_start_index);
			/* Add it to the sheet header */
			$sheet_header[$column] = $entry->name;
			/* Add this position to the entries_position array */
			$entries_position[$entry->id] = $column;
			/* Increase the index */
			$sheet_header_start_index++;
			/* If we've reached Z, we need to start doing Prefixes. */
			if(($sheet_header_start_pos + $sheet_header_start_index) >= ord('Z'))
			{
				if($sheet_header_prefix == ''){
					$sheet_header_prefix = 'A';
				}else{
					$sheet_header_prefix = ord($sheet_header_prefix);
					$sheet_header_prefix++;
					$sheet_header_prefix = chr($sheet_header_prefix);
				}
				$sheet_header_start_pos = ord('A');
				$sheet_header_start_index = 0;
			}
		}

	}

	/* 
		We now have our header row that we can use to'
		populate an excel sheet.
	*/

	/* Create a new excel object. */
	$excel = new PHPExcel();

	/*
		Lets get all the sections of the location.
	*/
	$section = $location->sections()->find_one($sid);

	
	/* Set the current sheet */
	$sheet = $excel->createSheet();

	/* Set the worksheet title */
	$sheet->setTitle(substr(preg_replace("/[^A-Za-z0-9]/","",$section->name), 0, 31));

	/* The current row we're working with */
	$row_index = 1;

	/* Fill in our headers. */
	foreach($sheet_header as $key => $value)
	{
		$sheet->setCellValue($key . $row_index, $value);
	}

	$row_index++;

	/* Get all of the PatrolEntries for this section */
	$patrol_entries = $section->patrol_entry()->find_many();

	/* For each patrol entry, fill out a row */
	foreach($patrol_entries as $patrol_entry)
	{
		/* Get the parent patrol. */
		$patrol = $patrol_entry->patrol()->find_one();

		/* Set the date */
		$sheet->setCellValue('A' . $row_index, $patrol->date);

		/* Get Volunteer information */
		$volunteer = $patrol->volunteer()->find_one();

		/* Set the values */
		if ($volunteer) {
			$sheet->setCellValue('B' . $row_index, $volunteer->first_name . ' ' . $volunteer->last_name);
		}
		if($patrol->coastkeeper_partner_id){
			$partner = $app['paris']->getModel('Coastkeeper\Volunteer')
								->find_one($patrol->coastkeeper_partner_id);
			$sheet->setCellValue('C' . $row_index, $partner->first_name . ' ' . $partner->last_name);
		}

		/* Set the start time and end time */
		$sheet->setCellValue('D' . $row_index , $patrol_entry->start_time);
		$sheet->setCellValue('E' . $row_index , $patrol_entry->end_time);

		/* Now get all the tallies for this patrol... */
		$tallies = $patrol_entry->patrol_tallies()->find_many();

		foreach($tallies as $tally)
		{
			$sheet->setCellValue($entries_position[$tally->coastkeeper_datasheet_entry_id] . $row_index, $tally->tally);
		}

		/* increase the row */
		$row_index++;

	}

	/* Remove the cover Sheet */
	$excel->removeSheetByIndex(0);

	$filename = $location->name . '-' . $section->name . ' ' . date('Y-m-d');

	/* Set the header values. */
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename.xls\"");
	header("Cache-control: max-age=0");

	/* Write the information */
	$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
	$writer->save("php://output");

	/* exit, as we don't need silex to do anything */
	exit;

})->assert('lid','\d+', 'sid', '\d+')->before($admin_login_check)->bind('admin_export_data_section');
/*
	Return the instance of the Silex application.
*/
return $admin;
