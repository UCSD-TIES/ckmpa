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

		return View::make('admin.volunteers.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['roles'] = Role::all();

      return View::make('admin.volunteers.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;

		if ($user->save())
		{
			$role = Role::find(Input::get('role'));
			$user->attachRole($role);

			return Redirect::route('admin.volunteers.index');
		}

		$errors = $user->errors();
		return Redirect::route('admin.volunteers.create')
			->withInput()
			->with('errors', $errors);
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
		$data['roles'] = Role::all();

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
		$user = User::find($id);
		if ($user->exists)
		{
			$user::$rules['password'] = (Input::get('password')) ? 'required|confirmed' : '';
			$user::$rules['password_confirmation'] = (Input::get('password')) ? 'required' : '';
		}

		if($user->updateUniques())
		{
			$user->roles()->sync(array(Input::get('role')));
			return Redirect::route('admin.volunteers.show', $id);
		}

		$errors = $user->errors();
		return Redirect::route('admin.volunteers.edit', $id)
			->withInput()
			->with('errors', $errors);

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

	/**
	 * Shows all the roles and permissions
	 * with the ability to edit them.
	 *
	 * @return \Illuminate\View\View
	 */
	public function permissions()
	{
		$data['roles'] = Role::all();
		$data['permissions'] = Permission::all();

		return View::make('admin.volunteers.permissions', $data);

	}

	/**
	 * Modifies permissions and roles from input.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postPermissions()
	{
		$permissions = DB::table('permissions')->lists('name');
		foreach(Role::all() as $role)
		{
			$perms = array();
			foreach($permissions as $permission)
				$perms[] = Input::get($role->name.'-'.$permission);

			$role->perms()->sync(array_filter($perms));
		}

		return Redirect::route('permissions')->with('success', 'Saved');
	}

	public function search()
	{
		$search = Input::get('search_string');
		$data['volunteers'] = User::where('first_name', $search)
			->orWhere('last_name', $search)->get();

		return View::make('admin.volunteers.list', $data);
	}
}
