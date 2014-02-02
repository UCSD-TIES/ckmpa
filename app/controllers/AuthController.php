<?php

class AuthController extends BaseController {

	public function postIndex()
	{
		if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
		{
		  return Response::json(Auth::user());
		} else {
		  return Response::json(array('flash' => 'Invalid username or password'), 500);
		}
	}

	public function getIndex()
	{
		return 'test';
	}

}
