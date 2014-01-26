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
 */
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