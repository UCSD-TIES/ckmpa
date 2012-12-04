<?php

namespace Coastkeeper;

use \Model;

class DatasheetEntry extends Model
{
	public function datasheet_category()
	{
		return $this->belongs_to('Coastkeeper\DatasheetCategory');
	}

	public function patrol_tallies()
	{
		return $this->has_many('Coastkeeper\PatrolTally');
	}
}