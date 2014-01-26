<?php

/**
 * An Eloquent Model: 'Tally'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $tally
 * @property integer $segment_id
 * @property integer $field_id
 * @property-read \Segment $segment
 * @property-read \Field $field
 */
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