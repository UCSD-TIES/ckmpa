<?php

class Section extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:sections'
	);

	protected $table = 'sections';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'location_id');
	protected $visible = array('name', 'location_id');

	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function segments()
	{
		return $this->hasMany('Segment');
	}
}