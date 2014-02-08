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
 * @property integer $mpa_id
 * @property-read \Mpa $mpa
 * @property-read \Illuminate\Database\Eloquent\Collection|\Patrol[] $patrols
 */
class Transect extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:transects'
	);

	protected $table = 'transects';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'mpa_id');
	protected $visible = array('name', 'mpa_id', 'id');

	public function mpa()
	{
		return $this->belongsTo('Mpa');
	}

	public function patrols()
	{
		return $this->hasMany('Patrol');
	}
}