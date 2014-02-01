<?php

/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

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
			return Redirect::route('login')
				->with('notice', Lang::get('confide::confide.alerts.account_created'));
		} else
		{
			// Get validation errors (see Ardent package)
			$errors = $user->errors();

			return Redirect::to('/users/register')
				->withInput(Input::except('password'))
				->with('errors', $errors);
		}
	}

	/**
	 * Displays the login form
	 *
	 */
	public function login()
	{
		if (Entrust::can('can_patrol'))
			return Redirect::route('select-MPA');

		return View::make('mobile/index');
	}

	/**
	 * Attempt to do login
	 *
	 */
	public function do_login()
	{
		$input = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'remember' => Input::get('remember'),
		);

		// If you wish to only allow login from confirmed users, call logAttempt
		// with the second parameter as true.
		// logAttempt will check if the 'email' perhaps is the username.
		// Get the value from the config file instead of changing the controller
		if (Confide::logAttempt($input, Config::get('confide::signup_confirm')))
		{
			// Redirect the user to the URL they were trying to access before
			// caught by the authentication filter IE Redirect::guest('user/login').
			// Otherwise fallback to '/'
			// Fix pull #145
			if(!Entrust::can('can_patrol')) {
				return Redirect::route('login')
				->with('message', 'Access Denied');
			}
			
			Session::put("start_time", Carbon::now());
			return Redirect::intended('/mobile/select-MPA');
		} else
		{
			$user = new User;

			// Check if there was too many login attempts
			if (Confide::isThrottled($input))
			{
				$err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
			} elseif ($user->checkUserExists($input) and !$user->isConfirmed($input))
			{
				$err_msg = Lang::get('confide::confide.alerts.not_confirmed');
			} else
			{
				$err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
			}

			return Redirect::route('login')
				->withInput(Input::except('password'))
				->with('message', $err_msg);
		}
	}

	/**
	 * Attempt to confirm account with code
	 *
	 * @param  string $code
	 */
	public function confirm($code)
	{
		if (Confide::confirm($code))
		{
			$notice_msg = Lang::get('confide::confide.alerts.confirmation');
			return Redirect::route('login')
				->with('notice', $notice_msg);
		} else
		{
			$error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
			return Redirect::route('login')
				->with('error', $error_msg);
		}
	}

	/**
	 * Displays the forgot password form
	 *
	 */
	public function forgot_password()
	{
		return View::make(Config::get('confide::forgot_password_form'));
	}

	/**
	 * Attempt to send change password link to the given email
	 *
	 */
	public function do_forgot_password()
	{
		if (Confide::forgotPassword(Input::get('email')))
		{
			$notice_msg = Lang::get('confide::confide.alerts.password_forgot');
			return Redirect::route('login')
				->with('notice', $notice_msg);
		} else
		{
			$error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
			return Redirect::action('UserController@forgot_password')
				->withInput()
				->with('error', $error_msg);
		}
	}

	/**
	 * Shows the change password form with the given token
	 *
	 */
	public function reset_password($token)
	{
		return View::make(Config::get('confide::reset_password_form'))
			->with('token', $token);
	}

	/**
	 * Attempt change password of the user
	 *
	 */
	public function do_reset_password()
	{
		$input = array(
			'token' => Input::get('token'),
			'password' => Input::get('password'),
			'password_confirmation' => Input::get('password_confirmation'),
		);

		// By passing an array with the token, password and confirmation
		if (Confide::resetPassword($input))
		{
			$notice_msg = Lang::get('confide::confide.alerts.password_reset');
			return Redirect::action('UserController@login')
				->with('notice', $notice_msg);
		} else
		{
			$error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
			return Redirect::action('UserController@reset_password', array('token' => $input['token']))
				->withInput()
				->with('error', $error_msg);
		}
	}

	/**
	 * Log the user out of the application.
	 *
	 */
	public function logout()
	{
		Confide::logout();
		Session::flush();

		return Redirect::to('/');
	}

}
