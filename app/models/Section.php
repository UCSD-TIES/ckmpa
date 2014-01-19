<?php

class Section extends Eloquent {
	protected $table = 'coastkeeper_section';

	public static $rules = array(
		'name'=>'required|min:2|unique:coastkeeper_section'
	);

	protected $fillable = array('name', 'coastkeeper_location_id');


	public function location()
	{
		return $this->belongsTo('Location', 'coastkeeper_location_id');
	}

	public function patrolEntries(){
		return $this->hasMany('PatrolEntry', 'coastkeeper_section_id');
	}
}