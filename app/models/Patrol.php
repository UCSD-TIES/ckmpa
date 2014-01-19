<?php

class Patrol extends Eloquent {
	protected $table = 'coastkeeper_patrol';

	public function location(){
		return $this->hasOne('Location', 'id', 'coastkeeper_location_id');
	}

	public function volunteer(){
		return $this->hasOne('User', 'id', 'coastkeeper_volunteer_id');
	}

	public function patrolEntries(){
		return $this->hasMany('PatrolEntry', 'coastkeeper_patrol_id');
	}

}