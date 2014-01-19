<?php

class Location extends Eloquent {
	protected $table = 'coastkeeper_location';

	public static $rules = array(
		'name'=>'required|alpha|min:2|unique:coastkeeper_location',
		'coastkeeper_datasheet_id'=>'required'
	);

	protected $fillable = array('name', 'coastkeeper_datasheet_id');

	public function sections()
	{
		return $this->hasMany('Section', 'coastkeeper_location_id');
	}

	public function datasheet()
	{
		return $this->hasOne('Datasheet', 'id', 'coastkeeper_datasheet_id');
	}

	public function patrols()
	{
		return $this->hasMany('Patrol', 'coastkeeper_location_id');
	}

}