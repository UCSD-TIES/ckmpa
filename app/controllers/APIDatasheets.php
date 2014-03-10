<?php

class APIDatasheets extends BaseController {
	public function getIndex()
	{
		$datasheets = Datasheet::with(array('categories', 'categories.fields', 'categories.subcategories', 'categories.fields.options'))->get();
		return $datasheets;
	}
}