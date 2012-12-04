<?php

namespace Coastkeeper;

use \Model;

class PatrolEntry extends Model
{
	public function patrol()
	{
		return $this->belongs_to('Coastkeeper\Patrol');
	}

	public function section()
	{
		return $this->belongs_to('Coastkeeper\Section');
	}

	public function patrol_tallies()
	{
		return $this->has_many('Coastkeeper\PatrolTally');
	}
}