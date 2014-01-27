<?php

class PatrolsController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['patrols'] = Patrol::all();

		return View::make('admin.patrols.list', $data);
	}

	/**
	 * (Not used) Show the form for creating a new resource.
	 *
	 * Create view is in MobileController.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('patrols.create');
	}

	/**
	 * (Not used) Store a newly created resource in storage
	 *
	 * Stored in MobileController instead.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * (Not used) Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('patrols.show');
	}

	/**
	 * (Not used) Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('patrols.edit');
	}

	/**
	 * (Not implemented) Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patrol::find($id)->delete();

		return Redirect::route('admin.patrols.index');
	}

	/**
	 * Shows all patrols for a given location.
	 *
	 * @return \Illuminate\View\View
	 */
	public function patrolEntries()
	{
		$data['patrols'] = Location::find(Input::get('location_id'))->patrols;

		return View::make('admin.patrols.list', $data);
	}

}
