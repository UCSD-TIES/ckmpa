<?php

class Subcategory extends Eloquent {
	// protected $guarded = array();
	protected $table = 'subcategories';

	public static $rules = array();

	public function category()
	{
		return $this->belongsTo('Category');
	}
}
