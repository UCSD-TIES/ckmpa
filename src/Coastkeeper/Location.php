<?php 

namespace Coastkeeper;

use \Model;

class Location extends Model{

	/*
	 * sections()
	 *
	 * Retrieves and array of Section objects
	 * that belong to the current Location object.
	 */
	public function sections()
	{
		return $this->has_many('Coastkeeper\Section');
	}

	/*
	 * patrols()
	 * 
	 * Retrieves an array of Patrol objects that
	 * belong to the current Location object.
	 */
	public function patrols()
	{
		return $this->has_many('Coastkeeper\Patrol');
	}

	/*
	 * datasheet()
	 * 
	 * Retrieves the Datasheet instance the
	 * current location belongs to.
	 */
	public function datasheet()
	{
		return $this->belongs_to('Coastkeeper\Datasheet');
	}

}