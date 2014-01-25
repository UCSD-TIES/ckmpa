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
		$data['url'] = "data-url=/mobile";

		return View::make('mobile.index');
	}

	public function getSelectLocation()
	{
		$locations = Location::all();
		$data['locations'] = $locations;
		$data['url'] = "data-url=/mobile/select-location";

		return View::make('mobile.select-location', $data);
	}

	public function getSelectSection($location_id)
	{
		$location = Location::find($location_id);
		$sections = $location->sections;
		$data['sections'] = $sections;
		$data['location'] = $location;

		return View::make('mobile.select-section', $data);
	}

	public function getDataCollection($section_id)
	{
		$section = Section::find($section_id);
		$data['section'] = $section;
		$data['datasheet'] = $section->location->datasheet;

		return View::make('mobile.data-collection', $data);

	}

	public function postDataCollection()
	{
		//Get the current section
		$section = Section::find(Input::get('section_id'));

		//Get the current patrol if on one
		//Else create a new patrol
		if (Session::has('patrol'))
			$patrol = Session::get('patrol');
		else
		{
			$patrol = new Patrol;

			/* Set the owner and location of the patrol */
			$patrol->user()->associate(Auth::user());
			$patrol->location()->associate($section->location);

			/* Set the date of the current patrol */
			$patrol->date = date('Y-m-d');
			$patrol->is_finished = 1;

			$patrol->save();

			/* Set as current patrol */
			Session::set('patrol', $patrol);
		}

		/* Get the TIME string. */
		$start_time = Session::get('start_time');

		/* Create a new patrol segment. */
		$segment = new Segment;

		/* Set the patrol and section of the segment */
		$segment->patrol()->associate($patrol);
		$segment->section()->associate($section);

		/* Set the times. */
		$segment->start_time = $start_time;
		$segment->end_time = date('H:i:s');

		// Save
		$segment->save();

		$datasheet = $section->location->datasheet;

		$categories = $datasheet->categories;
		/* For each category, get the entries. */
		foreach ($categories as $category)
		{
			$fields = $category->fields;
			/* For each entry, save the data. */
			foreach ($fields as $field)
			{
				/* Create a new tally */
				$tally = new Tally;

				/* Link it to the patrol */
				$tally->segment()->associate($segment);

				/* Link it to the datasheet entry */
				$tally->field()->associate($field);

				/* Fill in the tally */
				$tally->tally = (int)Input::get('field-' . $field->id);

				/* Save the information */
				$tally->save();
			}

		}

		$data['location'] = $section->location;
		return View::make('mobile.finish', $data);
	}

	public function finish()
	{
		return View::make('mobile.finish');
	}

}