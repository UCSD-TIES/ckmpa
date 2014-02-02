<?php

class UserAPIController extends BaseController {
	public function getIndex()
	{
		$users = User::with('roles')->get();
		return $users;
	}
}