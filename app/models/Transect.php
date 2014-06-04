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
 * @method static \Illuminate\Database\Query\Builder|\Transect whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transect whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transect whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transect whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Transect whereMpaId($value) 
 */
class Transect extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2|unique:transects'
	);

	protected $table = 'transects';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'mpa_id', 'pdf_path');
	protected $visible = array('name', 'mpa_id', 'id', 'pdf_path');

	public function mpa()
	{
		return $this->belongsTo('Mpa');
	}

	public function patrols()
	{
		return $this->hasMany('Patrol');
	}
}
