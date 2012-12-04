<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\Volunteer

	Available Fields:
	id
	first_name
	last_name
	password
	is_admin

 */
class Volunteer extends Model
{
	public function patrols()
	{
		return $this->has_many('Coastkeeper\Patrol');
	}
}