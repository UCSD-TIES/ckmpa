<?php

class SectionsController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['sections'] = Section::all();
		return View::make('admin.sections.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$location = Location::find(Input::get('id'));

		return View::make('admin.sections.create', compact('location'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Section::$rules);

		if ($validation->passes())
		{
			Section::create($input);

			return Redirect::route('admin.locations.show', Input::get('id'));
		}

		return Redirect::route('admin.sections.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('admin.sections.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$section = Section::find(Input::get('section_id'));
		$data['location'] = $section->location;
		$data['section'] = $section;

		return View::make('admin.sections.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Section::$rules);

		if ($validation->passes())
		{
			$section = Section::find(Input::get('section_id'));
			$section->update($input);

			return Redirect::route('admin.locations.show', $id);
		}

		return Redirect::route('admin.sections.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Section::find(Input::get('section_id'))->delete();

		return Redirect::route('admin.locations.show', $id);
	}

}
