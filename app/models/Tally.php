<?php

class Tally extends Eloquent {
	protected $table = 'tallies';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('tally', 'segment_id', 'item_id');
	protected $visible = array('tally', 'segment_id', 'item_id');

	public function segment()
	{
		return $this->belongsTo('Segment');
	}

	public function field()
	{
		return $this->belongsTo('Field');
	}

}