<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldsTable extends Migration {

	public function up()
	{
		Schema::create('fields', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('type');
			$table->integer('category_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('fields');
	}
}