<?php

class AdminController extends BaseController
{
	public function getIndex()
	{
		return View::make('admin/index');
	}

	public function getLogin()
	{
		return View::make('admin/login');
	}

	public function postLogin()
	{
		if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
		{
			return Redirect::intended('admin/')->with('message', 'You are now logged in!');
		} else
		{
			return Redirect::to('admin/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin/login')->with('message', 'Your are now logged out!');
	}

	public function exportData($id, $sid = null)
	{
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
		$location = Location::find($id);

		$filename = $location->name . '-' . date('Y-m-d');

		/* Get the datasheet, we'll need to set the header up */
		$datasheet = $location->datasheet;

		/* We're going to need to all the Entries for the datasheet as well. */
		$datasheet_categories = $datasheet->categories;
		/* Step through the categories to get the entires. */
		foreach ($datasheet_categories as $category)
		{
			$entries = $category->entries;

			/* Step through each entry and add them to the entries array. */
			foreach ($entries as $entry)
			{
				/* Get the next column */
				$column = $sheet_header_prefix . chr($sheet_header_start_pos + $sheet_header_start_index);
				/* Add it to the sheet header */
				$sheet_header[$column] = $entry->name;
				/* Add this position to the entries_position array */
				$entries_position[$entry->id] = $column;
				/* Increase the index */
				$sheet_header_start_index++;
				/* If we've reached Z, we need to start doing Prefixes. */
				if (($sheet_header_start_pos + $sheet_header_start_index) >= ord('Z'))
				{
					if ($sheet_header_prefix == '')
					{
						$sheet_header_prefix = 'A';
					} else
					{
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
		if ($sid)
			$sections = [Section::find($sid)];
		else
			$sections = $location->sections;

		/* For each section, lets make a sheet */
		foreach ($sections as $section)
		{
			/* Set the current sheet */
			$sheet = $excel->createSheet();

			/* Set the worksheet title */
			$sheet->setTitle(substr(preg_replace("/[^A-Za-z0-9]/", "", $section->name), 0, 31));

			/* The current row we're working with */
			$row_index = 1;

			/* Fill in our headers. */
			foreach ($sheet_header as $key => $value)
			{
				$sheet->setCellValue($key . $row_index, $value);
			}

			$row_index++;

			/* Get all of the PatrolEntries for this section */
			$patrol_entries = $section->patrolEntries;

			/* For each patrol entry, fill out a row */
			foreach ($patrol_entries as $patrol_entry)
			{
				/* Get the parent patrol. */
				$patrol = $patrol_entry->patrol;

				/* Set the date */
				$sheet->setCellValue('A' . $row_index, $patrol->date);

				/* Get Volunteer information */
				$volunteer = $patrol->volunteer;

				/* Set the values */
				if ($volunteer)
				{
					$sheet->setCellValue('B' . $row_index, $volunteer->first_name . ' ' . $volunteer->last_name);
				}

				/* Set the start time and end time */
				$sheet->setCellValue('D' . $row_index, $patrol_entry->start_time);
				$sheet->setCellValue('E' . $row_index, $patrol_entry->end_time);

				/* Now get all the tallies for this patrol... */
				$tallies = $patrol_entry->patrolTallies;

				foreach ($tallies as $tally)
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
	}

	public function graphs()
	{
		$data['datasheets'] = Datasheet::all();
		return View::make('admin.graphs.view', $data);
	}

	public function graphsData()
	{
		$messages = array();


		$startDate = Input::get('startDate');
		$endDate = Input::get('endDate');


		$startDate = DateTime::createFromFormat('m/d/Y', $startDate);
		$endDate = DateTime::createFromFormat('m/d/Y', $endDate);

		$finishedPatrols = Input::get('completePatrol');

		$datasheet_id = Input::get('datasheet');

		if (!$datasheet_id)
		{
			$messages['errors'] = "Please select a datasheet";
		}

		if (count($messages) <= 0)
		{
			$datasheet = Datasheet::find($datasheet_id);
			$locations = $datasheet->locations;
			$data = array();

			foreach ($locations as $location)
			{
				$sections = $location->sections;

				foreach ($sections as $section)
				{
					$patrol_entries = $section->patrolEntries;

					/* For each patrol entry, fill out a row */
					foreach ($patrol_entries as $patrol_entry)
					{

						/* Get the parent patrol. */
						$patrol = $patrol_entry->patrol;


						/*
						 * If the finished Patrol filter is on,
						 * ignore any patrols that arent finished
						 */
						if ($finishedPatrols && !$patrol->finished)
						{
							continue;
						}

						/*
						 * Filter out any patrols not in between the given dates
						 */
						if ($startDate && $endDate)
						{

							$patrolDate = DateTime::createFromFormat('Y-m-d', $patrol->date);

							if (($patrolDate < $startDate) || ($patrolDate > $endDate))
							{
								continue;
							}
						}

						/* Now get all the tallies for this patrol... */
						$tallies = $patrol_entry->patrolTallies;

						foreach ($tallies as $tally)
						{
							if ($tally->tally)
							{
								$datasheet_entry = $tally->datasheetEntry;

								if (array_key_exists($datasheet_entry->name, $data))
								{
									$data[$datasheet_entry->name] += $tally->tally;
								} else
								{
									$data[$datasheet_entry->name] = $tally->tally;
								}
							}
						}

					}
				}
			}

			return Response::json($data, 201);
		}

		return Response::json($messages, 201);
	}

	public function graphsObservations()
	{
		$messages = array();

		$startDate = Input::get('startDate');
		$endDate = Input::get('endDate');

		$startDate = DateTime::createFromFormat('m/d/Y', $startDate);
		$endDate = DateTime::createFromFormat('m/d/Y', $endDate);

		$finishedPatrols = Input::get('completePatrol');

		$datasheet_id = Input::get('datasheet');

		if (!$datasheet_id)
		{
			$messages['errors'] = "Please select a datasheet";
		}

		if (count($messages) <= 0)
		{
			$datasheet = Datasheet::find($datasheet_id);
			$patrols = Patrol::all();

			// return array
			$data = array();

			foreach ($patrols as $patrol)
			{
				if ($patrol->location && $patrol->location)
				{
					$patrol_datasheet = $patrol->location->datasheet;

					// check if patrols is in the datasheet
					if ($patrol_datasheet->id == $datasheet->id)
					{

						$patrol_entries = $patrol->patrolEntries;

						/* For each patrol entry, fill out a row */
						foreach ($patrol_entries as $patrol_entry)
						{

							/*
							 * If the finished Patrol filter is on,
							 * ignore any patrols that arent finished
							 */
							if ($finishedPatrols && !$patrol->finished)
							{
								continue;
							}

							/*
							 * Filter out any patrols not in between the given dates
							 */
							$patrolDate = DateTime::createFromFormat('Y-m-d', $patrol->date);
							if ($startDate && $endDate)
							{
								if (($patrolDate < $startDate) || ($patrolDate > $endDate))
								{
									continue;
								}
							}

							if (!array_key_exists($patrolDate->format('M Y'), $data))
							{
								$data[$patrolDate->format('M Y')] = array();
							}

							if (!array_key_exists('patrols', $data[$patrolDate->format('M Y')]))
							{
								$data[$patrolDate->format('M Y')]['patrols'] = 1;
							} else
							{
								$data[$patrolDate->format('M Y')]['patrols'] += 1;
							}

							/* Now get all the tallies for this patrol... */
							$tallies = $patrol_entry->patrolTallies;


							foreach ($tallies as $tally)
							{
								if (!array_key_exists('observations', $data[$patrolDate->format('M Y')]))
								{
									$data[$patrolDate->format('M Y')]['observations'] = 1;
								} else
								{
									$data[$patrolDate->format('M Y')]['observations'] += 1;
								}
							}
						}
					}
				}
			}

			return Response::json($data);
		}

		return Response::json($messages);
	}
}