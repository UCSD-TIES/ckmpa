<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options', function($table)
		{
		    $table->increments('id')->unsigned();
		    $table->string('name');
		    $table->integer('field_id')->unsigned();
		    $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('options');
	}

}
