<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\DatasheetEntry

	Available Fields:
	id
	coastkeeper_datasheet_category_id
	name
	use_report

 */
class DatasheetEntry extends Model
{
	/*
		Returns a query object of the Category
		the Entry belongs to.
	 */
	public function datasheet_category()
	{
		return $this->belongs_to('Coastkeeper\DatasheetCategory');
	}

	/*
		Returns a query object of all of the Tallies that belong
		to the entry.
	 */
	public function patrol_tallies()
	{
		return $this->has_many('Coastkeeper\PatrolTally');
	}
}