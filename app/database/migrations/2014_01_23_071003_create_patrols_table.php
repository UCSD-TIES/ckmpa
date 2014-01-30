<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatrolsTable extends Migration {

	public function up()
	{
		Schema::create('patrols', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->text('comments');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('transect_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('patrols');
	}
}