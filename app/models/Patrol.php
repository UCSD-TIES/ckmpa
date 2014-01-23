<?php

class Patrol extends Eloquent {
	protected $table = 'patrols';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('date', 'is_finished', 'user_id', 'location_id');
	protected $visible = array('date', 'is_finished', 'user_id', 'location_id');

	public function segments()
	{
		return $this->hasMany('Segment');
	}

	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

}