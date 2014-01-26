<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('username', 50)->unique();
			$table->string('email', 50);
			$table->string('password', 64);
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}