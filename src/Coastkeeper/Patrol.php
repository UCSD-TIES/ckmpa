<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\Patrol

	Available Fields:
	id
	coastkeeper_volunteer_id
	coastkeeper_partner_id
	coastkeeper_location_id
	date
	finished

 */
class Patrol extends Model
{
	/*
		Returns the Volunteer
		whom did the Patrol
	 */
	public function volunteer()
	{
		return $this->belongs_to('Coastkeeper\Volunteer');
	}

	/*
		Returns the Location that the
		patrol was performed.
	 */
	public function location()
	{
		return $this->belongs_to('Coastkeeper\Location');
	}

	/*
		Returns the entires relative to the
		patrol.
	 */
	public function patrol_entries()
	{
		return $this->has_many('Coastkeeper\PatrolEntry');
	}
}
