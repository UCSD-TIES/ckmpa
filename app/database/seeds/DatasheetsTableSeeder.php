<?php

class DatasheetsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('datasheets')->truncate();
		DB::table('categories')->truncate();
		DB::table('subcategories')->truncate();
		DB::table('fields')->truncate();
		DB::table('options')->truncate();

		$now = Carbon::now();

		$datasheets = array(
			array('name' => 'Default', 'created_at' => $now, 'updated_at' => $now)
		);

		$categories = array(
			array('name' => 'General', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'On-Shore Activities', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Off-Shore Activities', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boating Recreational', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boating Commercial', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boating Unknown', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Other', 'datasheet_id' => 1, 'created_at' => $now, 'updated_at' => $now),
		);
		$subcategories = array(
			array('name' => 'Rocky', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Sandy', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Inactive', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Active', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Inactive', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Active', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Inactive', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Active', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
		);

		$fields = array(
			array('name' => 'Clouds', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Precipitation', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Air Temperature', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Wind', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tide Level', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Visibility', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Beach Status', 'type' => 'radio', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Recreation', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Wildlife Watching', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Domestic animals on-leash', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Domestic animals off-leash', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Driving on the Beach', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Tide-pooling (not collecting)', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Hand collection of biota', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Shore-based hook and line fishing', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Shore-based trap fishing', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Shore-based net fishing', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Shore-based spear fishing', 'type' => 'number', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Board Sports', 'type' => 'number', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Offshore Recreation', 'type' => 'number', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Non-Consumptive SCUBA and snorkeling', 'type' => 'number', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Spear Fishing', 'type' => 'number', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Other Consumptive Diving ', 'type' => 'number', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Traps', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Line', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Nets', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Dive', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Spear', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Kelp Harvesting', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Unknown Fishing Boat', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Paddle Operated Boa', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Dive Boat (stationary – flag up)', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Whale Watching Boat', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Work Boat (e.g., life-guard, DFW)', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Commercial Passenger Fishing Vessel (5+ people)', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Other Boating', 'type' => 'number', 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Traps', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Line', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Nets', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Dive', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Spear', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Kelp Harvesting', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Unknown Fishing Boat', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Paddle Operated Boa', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Dive Boat (stationary – flag up)', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Whale Watching Boat', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Work Boat (e.g., life-guard, DFW)', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Commercial Passenger Fishing Vessel (5+ people)', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Other Boating', 'type' => 'number', 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Traps', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Line', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Nets', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Dive', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Fishing - Spear', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Boat Kelp Harvesting', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Unknown Fishing Boat', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Paddle Operated Boa', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Dive Boat (stationary – flag up)', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Whale Watching Boat', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Work Boat (e.g., life-guard, DFW)', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Commercial Passenger Fishing Vessel (5+ people)', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Other Boating', 'type' => 'number', 'category_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Scientific Research', 'type' => 'checkbox', 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Education', 'type' => 'checkbox', 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Beach Closure', 'type' => 'checkbox', 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Large Gatherings (e.g., volleyball tournament)', 'type' => 'checkbox', 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Enforcement Activity', 'type' => 'checkbox', 'category_id' => 7, 'created_at' => $now, 'updated_at' => $now)
		);

		$options = array(
			array('name' => 'Clear', 'field_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Partly Cloudy (1-50%)', 'field_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Cloudy (>50%cover)', 'field_id' => 1, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Yes', 'field_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'No', 'field_id' => 2, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Cold', 'field_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Cool', 'field_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Mild', 'field_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Warm', 'field_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Hot', 'field_id' => 3, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Calm', 'field_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Breezy', 'field_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Windy', 'field_id' => 4, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Low', 'field_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Medium', 'field_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'High', 'field_id' => 5, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Perfect', 'field_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Limited', 'field_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Shore Only', 'field_id' => 6, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Open', 'field_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Posted', 'field_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Closed', 'field_id' => 7, 'created_at' => $now, 'updated_at' => $now),
			array('name' => 'Unknown', 'field_id' => 7, 'created_at' => $now, 'updated_at' => $now),
		);


		// Uncomment the below to run the seeder
		DB::table('datasheets')->insert($datasheets);
		DB::table('categories')->insert($categories);
		DB::table('subcategories')->insert($subcategories);
		DB::table('fields')->insert($fields);
		DB::table('options')->insert($options);
	}

}
