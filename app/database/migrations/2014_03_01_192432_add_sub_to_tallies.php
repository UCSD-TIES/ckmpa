<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSubToTallies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tallies', function(Blueprint $table) {
			$table->integer('subcategory_id')->unsigned()->index();
			$table->foreign('subcategory_id')->references('id')->on('subcategories')
					->onDelete('restrict')
					->onUpdate('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tallies', function(Blueprint $table) {
			$table->dropForeign('tallies_subcategory_id_foreign');
			$table->drop('subcategory_id');
		});
	}

}
