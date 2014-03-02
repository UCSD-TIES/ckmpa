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
 * @property integer $patrol_id
 * @property-read \Patrol $patrol
 * @method static \Illuminate\Database\Query\Builder|\Tally whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tally whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tally whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tally whereTally($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tally wherePatrolId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tally whereFieldId($value) 
 */
class Tally extends Eloquent {
	protected $table = 'tallies';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('tally', 'patrol_id', 'field_id');
	protected $visible = array('tally', 'patrol_id', 'field_id', 'subcategory_id');

	public function patrol()
	{
		return $this->belongsTo('Patrol');
	}

	public function field()
	{
		return $this->belongsTo('Field');
	}

	public function subcategory()
	{
		return $this->belongsTo('Subcategory');
	}

}