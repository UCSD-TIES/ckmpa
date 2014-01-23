<?php

class Datasheet extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:datasheets'
	);

	protected $table = 'datasheets';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name');
	protected $visible = array('name');

	public function locations()
	{
		return $this->hasMany('Location');
	}

	public function categories()
	{
		return $this->hasMany('Category');
	}


}