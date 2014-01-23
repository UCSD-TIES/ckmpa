<?php

class Category extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2',
		'datasheet_id'=>'required'
	);

	protected $table = 'categories';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'datasheet_id');
	protected $visible = array('name', 'datasheet_id');

	public function datasheet()
	{
		return $this->belongsTo('Datasheet');
	}

	public function fields()
	{
		return $this->hasMany('Field');
	}
}