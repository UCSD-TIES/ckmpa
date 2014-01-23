<?php

class UsersController extends BaseController
{
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getRegister()
	{
		return View::make('users/register');
	}

	public function postRegister() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('users/register')->withErrors($validator)->withInput();
		}
	}

	public function getLogin() {
		return View::make('mobile/index');
	}

	public function postLogin() {
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
			Session::put("start_time", date('H:i:s'));
			return Redirect::route('select-location');
		} else {
			return Redirect::to('/')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}

	public function getIndex() {
		return View::make('mobile/index');
	}

	public function getLogout() {
		Session::flush();
		Auth::logout();
		return Redirect::route('login')->with('message', 'Your are now logged out!');
	}


}

?>