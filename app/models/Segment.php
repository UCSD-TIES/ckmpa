<?php

class Segment extends Eloquent {
	protected $table = 'segments';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('start_time', 'end_time', 'patrol_id', 'section_id');
	protected $visible = array('start_time', 'end_time', 'patrol_id', 'section_id');

	public function patrol()
	{
		return $this->belongsTo('Patrol');
	}

	public function tallies()
	{
		return $this->hasMany('Tally');
	}

	public function section()
	{
		return $this->belongsTo('Section');
	}

}