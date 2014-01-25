<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatasheetsTable extends Migration {

	public function up()
	{
		Schema::create('datasheets', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
		});
	}

	public function down()
	{
		Schema::drop('datasheets');
	}
}