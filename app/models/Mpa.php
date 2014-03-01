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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Transect[] $transects
 * @method static \Illuminate\Database\Query\Builder|\Mpa whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mpa whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mpa whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mpa whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Mpa whereDatasheetId($value) 
 */
class Mpa extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:mpas',
		'datasheet_id'=>'required'
	);

	protected $table = 'mpas';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'datasheet_id');
	protected $visible = array('name', 'datasheet_id', 'id', 'transects');

	public function transects()
	{
		return $this->hasMany('Transect');
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