<?php

use Zizaco\Entrust\EntrustRole;

/**
 * An Eloquent Model: 'Role'
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Permission[] $perms
 * @property mixed $permissions
 * @method static \Illuminate\Database\Query\Builder|\Role whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Role whereUpdatedAt($value) 
 */
class Role extends EntrustRole
{
	protected $fillable = array('name');


}