<?php

namespace Coastkeeper;

use \Model;

class Volunteer extends Model
{
	public function patrols()
	{
		return $this->has_many('Coastkeeper\Patrol');
	}
}