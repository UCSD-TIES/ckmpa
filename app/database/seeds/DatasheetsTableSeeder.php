<?php

class DatasheetsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('datasheets')->truncate();
		DB::table('categories')->truncate();
		DB::table('fields')->truncate();
		$now = Carbon::now();

		$datasheets = array(
			array('name' => 'Default', 'created_at' => $now, 'updated_at' => $now)
		);

		$categories = array(
			array('name' => 'Beach Uses', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Ocean Uses', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'General Pollution Issues', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now)
		);

		$fields = array(
			array('name' => 'Resting Leisure', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Active or Sporting Leisure', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Walking or Running', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Picnic or Grilling', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Domestic Animals', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Surfing or Swimming', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'ACTIVE Shore Fishing', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Recreational Boating', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Commercial Boating', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'ACTIVE Commercial Boating', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'ACTIVE Recreational Boat Fishing', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Diving', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Kelp Harvesting', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Runoff', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Open Dumpster', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Cigarette Butts', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Animal Droppings', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Litter', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
		);

		// Uncomment the below to run the seeder
		DB::table('datasheets')->insert($datasheets);
		DB::table('categories')->insert($categories);
		DB::table('fields')->insert($fields);

	}

}
