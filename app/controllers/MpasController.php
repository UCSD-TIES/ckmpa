<?php

class MpasController extends BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['mpas'] = Mpa::all();

		return View::make('admin.mpas.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['datasheets'] = Datasheet::all();

		return View::make('admin.mpas.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Mpa::$rules);

		if ($validation->passes())
		{
			Mpa::create($input);

			return Redirect::route('admin.mpas.index');
		}

		return Redirect::route('admin.mpas.create')
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
		$mpa = Mpa::findOrFail($id);
		$data['mpa'] = $mpa;
		$data['transects'] = $mpa->transects;

		return View::make('admin.mpas.view', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$mpa = Mpa::find($id);
		$data['mpa'] = $mpa;

		if (is_null($mpa))
		{
			return Redirect::route('mpas.index');
		}

		return View::make('admin.mpas.edit', $data);
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
		$validation = Validator::make($input, Mpa::$rules);

		if ($validation->passes())
		{
			$mpa = Mpa::find($id);
			$mpa->update($input);

			return Redirect::route('admin.mpas.show', $id);
		}

		return Redirect::route('admin.mpas.edit', $id)
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
		Mpa::find($id)->delete();

		return Redirect::route('admin.mpas.index');
	}

}
