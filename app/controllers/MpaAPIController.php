<?php

class MpaAPIController extends BaseController {
	public function getIndex()
	{
		$mpas = Mpa::with('transects')->get();
		return $mpas;
	}
}