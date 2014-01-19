<?php

class DatasheetsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datasheets = Datasheet::all();
        return View::make('admin.datasheets.list', compact('datasheets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin.datasheets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Datasheet::$rules);

		if ($validation->passes())
		{
			Datasheet::create($input);

			return Redirect::route('admin.datasheets.index');
		}

		return Redirect::route('admin.datasheets.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('admin.datasheets.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datasheet = Datasheet::find($id);

		if (is_null($datasheet))
		{
			return Redirect::route('admin.datasheets.index');
		}

		return View::make('admin.datasheets.edit', compact('datasheet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Datasheet::$rules);

		if ($validation->passes())
		{
			$datasheet = Datasheet::find($id);
			$datasheet->update($input);

			return Redirect::route('admin.categories.index', array('datasheet_id'=>$id));
		}

		return Redirect::route('admin.datasheets.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Datasheet::find($id)->delete();

		return Redirect::route('admin.datasheets.index');
	}

}
