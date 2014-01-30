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
 */
class Option extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function field()
	{
		return $this->belongsTo('Field');
	}
}
