<?php

class Location extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:locations',
		'datasheet_id'=>'required'
	);

	protected $table = 'locations';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'datasheet_id');
	protected $visible = array('name', 'datasheet_id');

	public function sections()
	{
		return $this->hasMany('Section');
	}

	public function patrols()
	{
		return $this->hasMany('Patrol');
	}

	public function datasheet()
	{
		return $this->belongsTo('Datasheet');
	}

}