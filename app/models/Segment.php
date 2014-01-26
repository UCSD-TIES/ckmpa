<?php

/**
 * An Eloquent Model: 'Segment'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $start_time
 * @property string $end_time
 * @property integer $patrol_id
 * @property integer $section_id
 * @property-read \Patrol $patrol
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tally[] $tallies
 * @property-read \Section $section
 */
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