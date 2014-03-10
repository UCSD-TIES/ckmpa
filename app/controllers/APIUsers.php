<?php

class APIUsers extends BaseController {
	public function postIndex()
	{
		$user = new User;

		if ($user->save())
		{
			$user->attachRole(2);

			return Response::json("Successfully Registered!");
		}

		$errors = $user->errors();
		return Response::json($errors, 403);

	}
}