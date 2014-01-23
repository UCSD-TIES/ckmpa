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
		Session::forget('location');
		$locations = Location::all();
		$data['locations'] = $locations;
		$data['url'] = "data-url=/mobile/select-location";

		return View::make('mobile.select-location', $data);
	}

	public function getSelectSection($id)
	{
		if (Session::has('location'))
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
		if (Session::has('patrol'))
			$patrol = Session::get('patrol');
		else
		{
			$patrol = new Patrol;

			/* Set the owner of the patrol */
			$patrol->user_id = Auth::user()->id;
			$patrol->location_id = Session::get('location');

			/* Set the date of the current patrol */
			$patrol->date = date('Y-m-d');

			/* Set as current patrol */
			$patrol->is_finished = 1;

			$patrol->save();
			Session::set('patrol', $patrol);
		}

		/* Start the patrol entry for the section. */
		$section = Section::find(Session::get('section'));

		/* Get the TIME string. */
		$start_time = Session::get('start_time');

		/* Create a new patrol. */
		$segment = new Segment;

		/* Set the proper ID's */
		$segment->patrol_id = $patrol->id;
		$segment->section_id = $section->id;

		/* Set the start time. */
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
				$tally->segment_id = $segment->id;

				/* Link it to the datasheet entry */
				$tally->field_id = $field->id;

				/* Fill in the tally */
				$tally->tally = (int)Input::get('field-' . $field->id);

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