<?php

class TransectsController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['transects'] = Transect::all();
		return View::make('admin.transects.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['mpa'] = Mpa::find(Input::get('id'));

		return View::make('admin.transects.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Transect::$rules);

		if ($validation->passes())
		{
			Transect::create($input);

			return Redirect::route('admin.mpas.show', Input::get('mpa_id'));
		}

		$data['id'] = Input::get('mpa_id');

		return Redirect::route('admin.transects.create', $data)
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
		return View::make('admin.transects.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$transect = Transect::find($id);
		$data['mpa'] = $transect->mpa;
		$data['transect'] = $transect;

		return View::make('admin.transects.edit', $data);
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
		$validation = Validator::make($input, Transect::$rules);

		if ($validation->passes())
		{
			$transect = Transect::find(Input::get('transect_id'));
			$transect->update($input);

			return Redirect::route('admin.mpas.show', $id);
		}

		return Redirect::route('admin.transects.edit', $id)
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
		Transect::find(Input::get('transect_id'))->delete();

		return Redirect::route('admin.mpas.show', $id);
	}

}
