<?php

/**
 * An Eloquent Model: 'Patrol'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $date
 * @property boolean $is_finished
 * @property integer $user_id
 * @property integer $location_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Segment[] $segments
 * @property-read \Location $location
 * @property-read \User $user
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 * @property string $comments
 * @property integer $transect_id
 * @property-read \Transect $transect
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tally[] $tallies
 */
class Patrol extends Eloquent {
	protected $table = 'patrols';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('date', 'user_id', 'transect_id');
	protected $visible = array('date', 'user_id', 'transect_id');

	public function transect()
	{
		return $this->belongsTo('Transect');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function tallies()
	{
		return $this->hasMany('Tally');
	}

	public function getDates()
	{
	    return array('created_at', 'updated_at', 'start_time', 'end_time');
	}

	public function getDateAttribute()
	{
		return $this->start_time;
	}

}