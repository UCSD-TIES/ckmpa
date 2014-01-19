<?php

class DatasheetEntry extends Eloquent {
	protected $table = 'coastkeeper_datasheet_entry';

	public static $rules = array(
		'name'=>'required|alpha|min:2',
		'coastkeeper_datasheet_category_id'=>'required'
	);

	protected $fillable = array('name', 'coastkeeper_datasheet_category_id');

}