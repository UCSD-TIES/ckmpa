<?php

/**
 * An Eloquent Model: 'Subcategory'
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Category $category
 * @method static \Illuminate\Database\Query\Builder|\Subcategory whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Subcategory whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Subcategory whereCategoryId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Subcategory whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Subcategory whereUpdatedAt($value) 
 */
class Subcategory extends Eloquent {
	// protected $guarded = array();
	protected $table = 'subcategories';

	public static $rules = array();

	public function category()
	{
		return $this->belongsTo('Category');
	}
}
