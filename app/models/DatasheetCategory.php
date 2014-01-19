<?php

class DatasheetCategory extends Eloquent {
	protected $table = 'coastkeeper_datasheet_category';

	public static $rules = array(
		'name'=>'required|alpha|min:2',
		'coastkeeper_datasheet_id'=>'required'
	);

	protected $fillable = array('name', 'coastkeeper_datasheet_id');

	public function entries()
	{
		return $this->hasMany('DatasheetEntry', 'coastkeeper_datasheet_category_id');
	}

	public function datasheet()
	{
		return $this->belongsTo('Datasheet', 'coastkeeper_datasheet_id');
	}

}