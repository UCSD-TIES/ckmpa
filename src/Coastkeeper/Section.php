<?php

namespace Coastkeeper;

use \Model;

class Section extends Model{
	
	/*
	 * location()
	 * 
	 * Retrieves the relative Location object based
	 * on coastkeeper_location_id column in the db.
	 */
	public function location()
	{
		return $this->belongs_to('Coastkeeper\Location');
	}

	/*
	 * patrol_entry()
	 *
	 */
	public function patrol_entry()
	{
		return $this->has_many('Coastkeeper\PatrolEntry');
	}

}