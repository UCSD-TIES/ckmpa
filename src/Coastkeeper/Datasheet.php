<?php

namespace Coastkeeper;

use \Model;

class Datasheet extends Model
{
	public function locations()
	{
		return $this->has_many('Coastkeeper\Location');
	}

	public function categories()
	{
		return $this->has_many('Coastkeeper\DatasheetCategory');
	} 
}