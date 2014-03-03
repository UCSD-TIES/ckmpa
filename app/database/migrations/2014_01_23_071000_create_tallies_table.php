<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTalliesTable extends Migration {

	public function up()
	{
		Schema::create('tallies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tally');
			$table->integer('patrol_id')->unsigned()->index();
			$table->integer('field_id')->unsigned()->index();
			$table->integer('subcategory_id')->unsigned()->index()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('tallies');
	}
}