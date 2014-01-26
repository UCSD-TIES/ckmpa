<?php

use Zizaco\Entrust\EntrustPermission;

/**
 * An Eloquent Model: 'Permission'
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Role[] $roles
 */
class Permission extends EntrustPermission
{
	protected $fillable = array('name', 'display_name');


}