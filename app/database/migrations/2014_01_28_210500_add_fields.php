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
		Schema::table('fields', function(Blueprint $table) {
			$table->string('type');
			
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->text('comment');
			
		});
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
		Schema::table('fields', function(Blueprint $table) {
			$table->dropColumn('type');
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->dropColumn('comment');
		});
		Schema::drop('options');
	}

}
