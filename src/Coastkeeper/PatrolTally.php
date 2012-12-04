<?php

namespace Coastkeeper;

use \Model;
/*

	Coastkeeper\PatrolTally

	Available Fields:
	id
	coastkeeper_patrol_entry_id
	coastkeeper_datasheet_entry_id
	tally

 */
class PatrolTally extends Model
{
	/*
		Returns the parent PatrolEntry
	 */
	public function patrol_entry()
	{
		return $this->belongs_to('Coastkeeper\PatrolEntry');
	}

	/*
		Returns the parent DatasheetEntry
	 */
	public function datasheet_entry()
	{
		return $this->belongs_to('Coastkeeper\DatasheetEntry');
	}

}