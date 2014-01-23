<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatrolsTable extends Migration {

	public function up()
	{
		Schema::create('patrols', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('date');
			$table->boolean('is_finished');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('location_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('patrols');
	}
}