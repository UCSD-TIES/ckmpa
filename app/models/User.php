<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;
use Zizaco\Entrust\HasRole;
use Zizaco\Confide\ConfideUser;


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
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereFirstName($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereLastName($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUsername($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereConfirmationCode($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereConfirmed($value) 
 */
class User extends Ardent implements UserInterface, RemindableInterface {
	use HasRole;

	public static $rules = array(
		'first_name'=>'required|min:2',
		'last_name'=>'required|min:2',
		'username'=>'required|unique:users',
		'email'=>'required|email',
		'password'=>'required|min:6|confirmed',
		'password_confirmation'=>'required',
	);

	protected $guarded = array('is_admin');
	protected $fillable = array('first_name', 'last_name', 'username', 'email', 'password', 'password_confirmation');
	protected $visible = array('first_name', 'last_name', 'username', 'email', 'id', 'roles');
	protected $hidden = array('password');

	public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
	public $forceEntityHydrationFromInput = true;
	public static $passwordAttributes = array('password');
	public $autoHashPasswordAttributes = true;
	public $autoPurgeRedundantAttributes = true;

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

    public function getRememberToken()
    {
      return $this->remember_token;
    }

    public function setRememberToken($value)
    {
      $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
      return 'remember_token';
    }

	public function patrols()
	{
		return $this->hasMany('Patrol');
	}

//	public function roles()
//	{
//		return $this->hasMany('Role');
//	}

}
