<?php

namespace Coastkeeper;

use \Model;

class PatrolTally extends Model
{
	
	public function patrol_entry()
	{
		return $this->belongs_to('Coastkeeper\PatrolEntry');
	}

	public function datasheet_entry()
	{
		return $this->belongs_to('Coastkeeper\DatasheetEntry');
	}

}