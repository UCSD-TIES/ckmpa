<?php

class APIMpas extends BaseController {
	public function getIndex()
	{
		$mpas = Mpa::with('transects')->get();
		return $mpas;
	}
}