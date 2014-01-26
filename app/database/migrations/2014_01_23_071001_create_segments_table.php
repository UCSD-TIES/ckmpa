<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSegmentsTable extends Migration {

	public function up()
	{
		Schema::create('segments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->time('start_time');
			$table->time('end_time');
			$table->integer('patrol_id')->unsigned()->index();
			$table->integer('section_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('segments');
	}
}