<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();
		DB::table('assigned_roles')->truncate();

		$password = Hash::make('testing');
		$now = Carbon::now();
		$users = array(
			array('first_name' => 'Iam', 'last_name' => 'Admin', 'username' => 'ck',
				'password' => $password, 'email' => 'admin@ck.com', 'created_at' => $now, 'updated_at' => $now),
			array('first_name' => 'Jane', 'last_name' => 'Doe', 'username' => 'user',
				'password' => $password, 'email' => 'girl@ck.com', 'created_at' => $now, 'updated_at' => $now),
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
		$admin = User::find(1);
		$admin->attachRole(1);
		$volunteer = User::find(2);
		$volunteer->attachRole(2);

	}

}
