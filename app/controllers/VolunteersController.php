<?php

class VolunteersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$volunteers = User::all();
		$data['volunteers'] = $volunteers;
		return View::make('admin/volunteers/list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin.volunteers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			unset($input['password_confirmation']);
			User::create($input);

			return Redirect::route('admin.volunteers.index');
		}

		return Redirect::route('admin.volunteers.create')
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
		$volunteer = User::find($id);
		$data['volunteer'] = $volunteer;
		$data['patrols'] = $volunteer->patrols;
        return View::make('admin.volunteers.view', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$volunteer = User::find($id);
		$data['volunteer'] = $volunteer;
        return View::make('admin.volunteers.edit', $data);
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
		$rules = User::$rules;
		$rules['username'] = 'required|unique:coastkeeper_volunteer,username,'.$id;
		unset($rules['password']);
		unset($rules['password_confirmation']);
		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{
			$volunteer = User::find($id);
			$volunteer->update($input);

			return Redirect::route('admin.volunteers.show', $id);
		}

		return Redirect::route('admin.volunteers.edit', $id)
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
		User::find($id)->delete();

		return Redirect::route('admin.volunteers.index');
	}
}
