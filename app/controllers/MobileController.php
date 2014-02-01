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
	 * Shows the select MPA view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getSelectMPA()
	{
		$mpas = Mpa::all();
		$data['mpas'] = $mpas;

		// jQuery Mobile hack to show correct url after a post
		$data['url'] = "data-url=/mobile/select-MPA";

		return View::make('mobile.select-MPA', $data);
	}

	/**
	 * Shows the select transect view.
	 *
	 * @param $MPA_id
	 * @return \Illuminate\View\View
	 */
	public function getSelectTransect($mpa_id)
	{
		$mpa = Mpa::find($mpa_id);
		$data['transects'] = $mpa->transects;;
		$data['mpa'] = $mpa;

		return View::make('mobile.select-transect', $data);
	}

	/**
	 * Shows the data collection view.
	 *
	 * @param $transect_id
	 * @return \Illuminate\View\View
	 */
	public function getDataCollection($transect_id)
	{
		$transect = Transect::find($transect_id);
		$data['transect'] = $transect;
		$data['datasheet'] = $transect->mpa->datasheet;

		return View::make('mobile.data-collection', $data);
	}

	/**
	 * Posts the data collected.
	 *
	 * @return \Illuminate\View\View
	 */
	public function postDataCollection()
	{
		// Get the current transect
		$transect = Transect::find(Input::get('transect_id'));

		$patrol = new Patrol;

		/* Set the owner and MPA of the patrol */
		$patrol->user()->associate(Auth::user());
		$patrol->transect()->associate($transect);

		/* Get the start time from login. */
		$start_time = Session::get('start_time');

		/* Set the date of the current patrol */
		// TEMPORARY
		$patrol->start_time = Carbon::now();
		$patrol->end_time = Carbon::now();
		$patrol->comments = Input::get('comments');

		$patrol->save();

		$datasheet = $transect->mpa->datasheet;

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
				$tally->patrol()->associate($patrol);

				/* Link it to the datasheet entry */
				$tally->field()->associate($field);

				/* Fill in the tally */
				// TODO tally the non numerics
				$underscored = str_replace(' ', '_', $field->name);
				$tally->tally = (int)Input::get($underscored);

				/* Save the information */
				$tally->save();
			}

		}

		$data['mpa'] = $transect->mpa;
		$data['url'] = "data-url=/mobile/finish";
		return View::make('mobile.finish', $data);
	}

	/**
	 * Shows the summary and comments view/
	 *
	 */
	public function summary()
	{
		$data['inputs'] = Input::except('transect_id');
		$data['keys'] = array_keys(Input::except('transect_id'));
		$data['transect'] = Transect::find(Input::get('transect_id'));

		return View::make('mobile.summary', $data);
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