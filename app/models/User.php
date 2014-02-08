<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;



/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $confirmation_code
 * @property boolean $confirmed
 * @property-read \Illuminate\Database\Eloquent\Collection|\Patrol[] $patrols
 * @property-read \Illuminate\Database\Eloquent\Collection|\Role[] $roles
 */
class User extends ConfideUser implements UserInterface, RemindableInterface {
	use HasRole;

	public static $rules = array(
		'first_name'=>'required|min:2',
		'last_name'=>'required|min:2',
		'username'=>'required|unique:users',
		'email'=>'required|email',
		'password'=>'required|between:6,30|confirmed',
		'password_confirmation'=>'required|between:6,30',
	);

	public static $relationsData = array(
		'roles'  => array(self::HAS_MANY, 'Role'),
	);

	protected $guarded = array('is_admin');
	protected $fillable = array('first_name', 'last_name', 'username', 'email', 'password', 'password_confirmation');
	protected $visible = array('first_name', 'last_name', 'username', 'email', 'id', 'roles');
	protected $hidden = array('password');

	public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
	public $forceEntityHydrationFromInput = true;

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
		return $this->hasMany('Patrol');
	}

}