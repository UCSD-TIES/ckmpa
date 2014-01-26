<?php

class LocationsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('locations')->truncate();
		DB::table('sections')->truncate();
		$now = Carbon::now();

		$locations = array(
			array('name' => 'Matlahuayl SMR', 'datasheet_id' => 1,
			'created_at' => $now, 'updated_at' => $now),
			array('name' => 'South La Jolla SMR', 'datasheet_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
		);

		$sections = array(
			array('name' => 'Scripps Pier to Tower 31', 'location_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tower 31 to Boat Launch', 'location_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Launch to Coastal Access', 'location_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Coast Walk Lookout', 'location_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Point La Jolla / Bridge Club', 'location_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Palomar Street', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Costa and Chelsea Viewpoint', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Hermosa Park', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Forward Street Viewpoint', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Calumet Park', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tourmaline Surf Park', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tourmaline to Diamond Street Beach Walk', 'location_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
		);

		// Uncomment the below to run the seeder
		DB::table('locations')->insert($locations);
		DB::table('sections')->insert($sections);
	}

}
