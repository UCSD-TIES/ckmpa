<?php

class PatrolsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('patrols')->truncate();
		DB::table('segments')->truncate();
		DB::table('tallies')->truncate();

		$fields = Field::all();
		$now = Carbon::now();
		$location_count = DB::table('locations')->count();
		$user_count = DB::table('users')->count();

		for($i = 1; $i <= 5; $i++) {
			$location = Location::find(rand(1,$location_count));
			$patrol = new Patrol;
			$patrol->date = $now->addMonth(1);
			$patrol->is_finished = 1;
			$patrol->user()->associate(User::find(rand(1,$user_count)));
			$patrol->location()->associate($location);
			$patrol->save();
			for($j = 1; $j <= 4; $j++) {
				$section_count = DB::table('sections')->where('location_id', '=', $location->id)->count();
				$section = $location->sections[rand(0,$section_count-1)];
				$segment = new Segment;

				/* Set the patrol and section of the segment */
				$segment->patrol()->associate($patrol);
				$segment->section()->associate($section);

				/* Set the times. */
				$segment->start_time = $now;
				$segment->end_time = $now->addHours(rand(1,4));

				// Save
				$segment->save();
				foreach($fields as $field) {
					$tally = new Tally;

					/* Link it to the patrol */
					$tally->segment()->associate($segment);

					/* Link it to the datasheet entry */
					$tally->field()->associate($field);

					/* Fill in the tally */
					$tally->tally = rand(1,20);

					/* Save the information */
					$tally->save();
				}
			}

		}

	}

}
