<?php

class PatrolAPIController extends BaseController {
	public function postIndex()
	{
		$transect = Transect::find(Input::get('transect'));
		$comments = Input::get('comments');

		$patrol = new Patrol;

		$patrol->user()->associate(Auth::user());
		$patrol->transect()->associate($transect);
		$patrol->comments = $comments;

		//TODO: Actual time
		$patrol->start_time = Carbon::now();
		$patrol->end_time = Carbon::now();

		$patrol->save();

		$tallies = Input::get('tallies');

		foreach($tallies as $t)
		{
			$tally = new Tally;
			$field = Field::find($t['field']['id']);
			if(array_key_exists('subcategory', $t))
			{
				$sub = Subcategory::find($t['subcategory']['id']);
				if($sub)
					$tally->subcategory()->associate($sub);
			}

			$tally->patrol()->associate($patrol);
			$tally->field()->associate($field);
			$tally->tally = $t['val'];

			$tally->save();
		}

		return $patrol;
	}
}