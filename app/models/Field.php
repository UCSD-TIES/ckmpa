<?php

class Field extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2',
		'category_id'=>'required'
	);

	protected $table = 'fields';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'category_id');
	protected $visible = array('name', 'category_id');

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function tallies()
	{
		return $this->hasMany('Tally');
	}

}