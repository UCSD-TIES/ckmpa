<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;



class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $rules = array(
		'first_name'=>'required|alpha|min:2',
		'last_name'=>'required|alpha|min:2',
		'username'=>'required|unique:users',
		'email'=>'required|email',
		'password'=>'required|alpha_num|between:6,20|confirmed',
		'password_confirmation'=>'required|alpha_num|between:6,20'
	);

	protected $fillable = array('first_name', 'last_name', 'username', 'password', 'password_confirmation', 'is_admin');


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function patrols()
	{
		return $this->hasMany('Patrol', 'coastkeeper_volunteer_id');
	}

}