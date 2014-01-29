<?php

/**
 * An Eloquent Model: 'Field'
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $category_id
 * @property-read \Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tally[] $tallies
 */
class Field extends Eloquent {
	public static $rules = array(
		'name'=>'required|min:2',
		'category_id'=>'required'
	);

	protected $table = 'fields';
	public $timestamps = true;
	protected $softDelete = false;
	protected $fillable = array('name', 'category_id', 'type');
	protected $visible = array('name', 'category_id', 'type');

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function tallies()
	{
		return $this->hasMany('Tally');
	}

	public function options()
	{
		return $this->hasMany('Option');
	}

}