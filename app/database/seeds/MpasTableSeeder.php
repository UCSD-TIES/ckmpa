<?php

class MpasTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('mpas')->truncate();
		DB::table('transects')->truncate();
		$now = Carbon::now();

		$mpas = array(
			array('name' => 'Matlahuayl SMR', 'datasheet_id' => 1,
			'created_at' => $now, 'updated_at' => $now),
			array('name' => 'South La Jolla SMR', 'datasheet_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
		);

		$transects = array(
			array('name' => 'Scripps Pier to Tower 31', 'mpa_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tower 31 to Boat Launch', 'mpa_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Launch to Coastal Access', 'mpa_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Coast Walk Lookout', 'mpa_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Point La Jolla / Bridge Club', 'mpa_id' => 1,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Palomar Street', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Costa and Chelsea Viewpoint', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Hermosa Park', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Forward Street Viewpoint', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Calumet Park', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tourmaline Surf Park', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tourmaline to Diamond Street Beach Walk', 'mpa_id' => 2,
				'created_at' => $now, 'updated_at' => $now),
		);

		// Uncomment the below to run the seeder
		DB::table('mpas')->insert($mpas);
		DB::table('transects')->insert($transects);
	}

}
