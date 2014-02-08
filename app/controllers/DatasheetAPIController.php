<?php

class DatasheetAPIController extends BaseController {
	public function getIndex()
	{
		$datasheets = Datasheet::with(array('categories', 'categories.fields', 'categories.fields.options'))->get();
		return $datasheets;
	}
}