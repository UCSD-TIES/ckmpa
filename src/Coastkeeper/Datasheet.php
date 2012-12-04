<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\Datasheet

	Available Fields:
	id
	name

 */
class Datasheet extends Model
{
	/*
		Returns a query object of Locations
		belonging to the datasheet.
	 */
	public function locations()
	{
		return $this->has_many('Coastkeeper\Location');
	}

	/*
		Returns a query object of Categories
		belonging to the datasheet.
	 */
	public function categories()
	{
		return $this->has_many('Coastkeeper\DatasheetCategory');
	} 
}