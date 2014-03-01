<?php

/**
 * An Eloquent Model: 'Option'
 *
 * @property integer $id
 * @property string $name
 * @property integer $field_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Field $field
 * @method static \Illuminate\Database\Query\Builder|\Option whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Option whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Option whereFieldId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Option whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Option whereUpdatedAt($value) 
 */
class Option extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function field()
	{
		return $this->belongsTo('Field');
	}
}
