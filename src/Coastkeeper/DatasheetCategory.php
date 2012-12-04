<?php

namespace Coastkeeper;

use \Model;

class DatasheetCategory extends Model
{
	public function datasheet()
	{
		return $this->belongs_to('Coastkeeper\Datasheet');
	}

	public function entries()
	{
		return $this->has_many('Coastkeeper\DatasheetEntry');
	}
}