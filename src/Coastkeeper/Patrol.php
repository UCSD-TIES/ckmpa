<?php

namespace Coastkeeper;

use \Model;

class Patrol extends Model
{
	public function volunteer()
	{
		return $this->belongs_to('Coastkeeper\Volunteer');
	}

	public function location()
	{
		return $this->belongs_to('Coastkeeper\Location');
	}

	public function patrol_entries()
	{
		return $this->has_many('Coastkeeper\PatrolEntry');
	}
}
