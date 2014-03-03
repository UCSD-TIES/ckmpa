<?php

class UsersController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Displays the form for account creation
	 *
	 */
	public function register()
	{
		return View::make('mobile.register');
	}

	/**
	 * Stores new account
	 *
	 */
	public function store()
	{
		$user = new User;

		if ($user->save())
		{
			$user->attachRole(2);
			return Redirect::route('login');
		} else
		{
			// Get validation errors (see Ardent package)
			$errors = $user->errors();

			return Redirect::to('/users/register')
					->withInput(Input::except('password'))
					->with('errors', $errors);
		}
	}
}
