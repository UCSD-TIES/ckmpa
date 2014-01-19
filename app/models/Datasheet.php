<?php

class Datasheet extends Eloquent {
	protected $table = 'coastkeeper_datasheet';

	public static $rules = array(
		'name'=>'required|min:2|unique:coastkeeper_datasheet'
	);

	protected $fillable = ['name'];

	public function categories()
	{
		return $this->hasMany('DatasheetCategory', 'coastkeeper_datasheet_id');
	}

	public function locations()
	{
		return $this->hasMany('Location', 'coastkeeper_datasheet_id');
	}

}