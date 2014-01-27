<?php

class MobileController extends BaseController
{
	/**
	 * Shows the login view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getIndex()
	{
		//$data['url'] = "data-url=/mobile";

		return View::make('mobile.index');
	}

	/**
	 * Shows the select location view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getSelectLocation()
	{
		$locations = Location::all();
		$data['locations'] = $locations;

		// jQuery Mobile hack to show correct url after a post
		$data['url'] = "data-url=/mobile/select-location";

		return View::make('mobile.select-location', $data);
	}

	/**
	 * Shows the select section view.
	 *
	 * @param $location_id
	 * @return \Illuminate\View\View
	 */
	public function getSelectSection($location_id)
	{
		$location = Location::find($location_id);
		$sections = $location->sections;
		$data['sections'] = $sections;
		$data['location'] = $location;

		return View::make('mobile.select-section', $data);
	}

	/**
	 * Shows the data collection view.
	 *
	 * @param $section_id
	 * @return \Illuminate\View\View
	 */
	public function getDataCollection($section_id)
	{
		$section = Section::find($section_id);
		$data['section'] = $section;
		$data['datasheet'] = $section->location->datasheet;

		return View::make('mobile.data-collection', $data);
	}

	/**
	 * Posts the data collected.
	 *
	 * @return \Illuminate\View\View
	 */
	public function postDataCollection()
	{
		// Get the current section
		$section = Section::find(Input::get('section_id'));

		// Get the current patrol from session if there is one
		// Else create a new patrol and store in session
		if (Session::has('patrol'))
			$patrol = Session::get('patrol');
		else
		{
			$patrol = new Patrol;

			/* Set the owner and location of the patrol */
			$patrol->user()->associate(Auth::user());
			$patrol->location()->associate($section->location);

			/* Set the date of the current patrol */
			$patrol->date = Carbon::now();
			$patrol->is_finished = 1;

			$patrol->save();

			/* Set as current patrol */
			Session::set('patrol', $patrol);
		}

		/* Get the start time from login. */
		$start_time = Session::get('start_time');

		/* Create a new patrol segment. */
		$segment = new Segment;

		/* Set the patrol and section of the segment */
		$segment->patrol()->associate($patrol);
		$segment->section()->associate($section);

		/* Set the times. */
		$segment->start_time = $start_time;
		$segment->end_time = Carbon::now();

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

	/**
	 * Shows the finish view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function finish()
	{
		return View::make('mobile.finish');
	}

}