<?php

class MobileController extends BaseController
{

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('mobile.index');
	}

	public function getSelectLocation()
	{
		$locations = Location::all();
		$data['locations'] = $locations;

		return View::make('mobile.select-location', $data);
	}

	public function getSelectSection($id)
	{
		if(Session::has('location'))
			$id = Session::get('location');
		else
			Session::set('location', $id);

		$location = Location::find($id);
		$sections = $location->sections;
		$data['sections'] = $sections;

		return View::make('mobile.select-section', $data);
	}

	public function getDataCollection($id)
	{
		Session::set('section', $id);
		$datasheet = Location::find(Session::get('location'))->datasheet;

		return View::make('mobile.data-collection', array('datasheet' => $datasheet));

	}

	public function postDataCollection()
	{
		$patrol = new Patrol;

		/* Set the owner of the patrol */
		$patrol->coastkeeper_volunteer_id = Auth::user()->id;
		$patrol->coastkeeper_location_id = Session::get('location');

		/* Set the date of the current patrol */
		$patrol->date = date('Y-m-d');

		/* Set as current patrol */
		$patrol->finished = 1;

		$patrol->save();

		/* Start the patrol entry for the section. */
		$section = Section::find(Session::get('section'));

		/* Get the TIME string. */
		$start_time = Session::get('start_time');

		/* Create a new patrol. */
		$section_patrol = new PatrolEntry;

		/* Set the proper ID's */
		$section_patrol->coastkeeper_patrol_id = $patrol->id;
		$section_patrol->coastkeeper_section_id = $section->id;

		/* Set the start time. */
		$section_patrol->start_time = $start_time;
		$section_patrol->end_time = date('H:i:s');

		// Save
		$section_patrol->save();

		$datasheet = $section->location->datasheet;

		$categories = $datasheet->categories;
		/* For each category, get the entries. */
		foreach ($categories as $category)
		{
			$entries = $category->entries;
			/* For each entry, save the data. */
			foreach ($entries as $entry)
			{
				/* Create a new tally */
				$tally = new PatrolTally;

				/* Link it to the patrol */
				$tally->coastkeeper_patrol_entry_id = $section_patrol->id;

				/* Link it to the datasheet entry */
				$tally->coastkeeper_datasheet_entry_id = $entry->id;

				/* Fill in the tally */
				$tally->tally = (int)Input::get('entry-' . $entry->id);

				/* Save the information */
				$tally->save();
			}

		}

		return Redirect::route('finish');

	}

	public function finish()
	{
		return View::make('mobile.finish');
	}

}