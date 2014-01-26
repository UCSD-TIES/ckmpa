<?php

/**
 * An Eloquent Model: 'Location'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $datasheet_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Section[] $sections
 * @property-read \Illuminate\Database\Eloquent\Collection|\Patrol[] $patrols
 * @property-read \Datasheet $datasheet
 */
class Location extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:locations',
		'datasheet_id'=>'required'
	);

	protected $table = 'locations';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'datasheet_id');
	protected $visible = array('name', 'datasheet_id');

	public function sections()
	{
		return $this->hasMany('Section');
	}

	public function patrols()
	{
		return $this->hasMany('Patrol');
	}

	public function datasheet()
	{
		return $this->belongsTo('Datasheet');
	}

}