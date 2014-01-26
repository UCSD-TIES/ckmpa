<?php

/**
 * An Eloquent Model: 'Section'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $location_id
 * @property-read \Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\Segment[] $segments
 */
class Section extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:sections'
	);

	protected $table = 'sections';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'location_id');
	protected $visible = array('name', 'location_id');

	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function segments()
	{
		return $this->hasMany('Segment');
	}
}