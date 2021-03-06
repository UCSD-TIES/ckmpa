<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = Password::remind(Input::only('email'), function($message)
		{
			$message->subject('Password Reset for MPA Watch');
		});
		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
				'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->updateUniques();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/admin')->with('success', "Your Password Has Been Reset");
		}
	}

	public function postForgetUsername()
	{
		$email = Input::get('email');
		$user = User::where('email', $email)->first();

		$data = array(
				'username' => $user->username,
				'email' => $email
		);

		Mail::send('emails.forgetUserName', $data, function ($message) use($email, $user)
		{
			$message->to($email, $user->first_name.$user->last_name)->subject('Username Retrieval for Coastkeeper MPA Watch');
		});

		return Redirect::back();
	}

}