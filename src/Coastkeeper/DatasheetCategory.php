<?php

namespace Coastkeeper;

use \Model;
/*
	Coastkeeper\DatasheetCategory

	Available Fields:
	id
	coastkeeper_datasheet_id
	name

 */
class DatasheetCategory extends Model
{
	/*
		Returnes a query object for the datasheet
		beloging to the category.
	 */
	public function datasheet()
	{
		return $this->belongs_to('Coastkeeper\Datasheet');
	}
	/*
		Returns a query object with all the Entries
		relative to the category.
	 */
	public function entries()
	{
		return $this->has_many('Coastkeeper\DatasheetEntry');
	}
}