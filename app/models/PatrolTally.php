<?php

class PatrolTally extends Eloquent {
	protected $table = 'coastkeeper_patrol_tally';

	public function datasheetEntry(){
		return $this->belongsTo('DatasheetEntry', 'coastkeeper_datasheet_entry_id');
	}

}