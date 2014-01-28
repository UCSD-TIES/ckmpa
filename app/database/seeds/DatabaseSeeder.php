<?php


class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('RolesPermissionsTableSeeder');
		$this->call('LocationsTableSeeder');
		$this->call('DatasheetsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('PatrolsTableSeeder');
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}