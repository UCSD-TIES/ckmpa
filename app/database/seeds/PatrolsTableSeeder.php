<?php

class PatrolsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('patrols')->truncate();
		DB::table('tallies')->truncate();

		$now = Carbon::now();
		$transect_count = Transect::count();
		$user_count = User::count();
		$field_count = Field::count();
		$patrols = array();
		$tallies = array();

		for($i = 1; $i <= 100; $i++) {
			$time = Carbon::createFromDate(null, rand(1,12), rand(1,30));
			$patrols[] = array('user_id'=> rand(1,$user_count), 'transect_id'=> rand(1,$transect_count),
				'created_at'=> $now, 'updated_at'=> $now,'start_time'=> $time->addMonth(), 'end_time'=> $time->addHour());

			for($j = 1; $j <= $field_count; $j++) {
				$tallies[] = array('patrol_id'=> $i, 'field_id'=> $j, 'tally'=> rand(0,20),
					'created_at'=> $now, 'updated_at'=> $now);
			}
		}

		DB::table('patrols')->insert($patrols);
		DB::table('tallies')->insert($tallies);

	}

}
