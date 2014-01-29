<?php

class Option extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function field()
	{
		return $this->belongsTo('Field');
	}
}
