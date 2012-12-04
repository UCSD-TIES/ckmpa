<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\PatrolEntry

	Available Fields:
	id
	coastkeeper_patrol_id
	coastkeeper_section_id
	start_time
	end_time

 */
class PatrolEntry extends Model
{
	/*
		Returns the parent Patrol
	 */
	public function patrol()
	{
		return $this->belongs_to('Coastkeeper\Patrol');
	}

	/*
		Returns the parent Section
	 */
	public function section()
	{
		return $this->belongs_to('Coastkeeper\Section');
	}

	/*
		Returns all of the tallies for this
		Patrol Entry.
	 */
	public function patrol_tallies()
	{
		return $this->has_many('Coastkeeper\PatrolTally');
	}
}