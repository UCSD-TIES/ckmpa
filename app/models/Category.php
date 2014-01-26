<?php

/**
 * An Eloquent Model: 'Category'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $datasheet_id
 * @property-read \Datasheet $datasheet
 * @property-read \Illuminate\Database\Eloquent\Collection|\Field[] $fields
 */
class Category extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2',
		'datasheet_id'=>'required'
	);

	protected $table = 'categories';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'datasheet_id');
	protected $visible = array('name', 'datasheet_id');

	public function datasheet()
	{
		return $this->belongsTo('Datasheet');
	}

	public function fields()
	{
		return $this->hasMany('Field');
	}
}