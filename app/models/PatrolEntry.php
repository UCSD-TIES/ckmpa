<?php

class PatrolEntry extends Eloquent {
	protected $table = 'coastkeeper_patrol_entry';

	public function patrol(){
		return $this->belongsTo('Patrol', 'coastkeeper_patrol_id');
	}

	public function patrolTallies(){
		return $this->hasMany("PatrolTally", 'coastkeeper_patrol_entry_id');
	}

}