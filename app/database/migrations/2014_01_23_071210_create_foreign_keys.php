<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('patrols', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('patrols', function(Blueprint $table) {
			$table->foreign('transect_id')->references('id')->on('transects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('mpas', function(Blueprint $table) {
			$table->foreign('datasheet_id')->references('id')->on('datasheets')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->foreign('datasheet_id')->references('id')->on('datasheets')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('fields', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('transects', function(Blueprint $table) {
			$table->foreign('mpa_id')->references('id')->on('mpas')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->foreign('patrol_id')->references('id')->on('patrols')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->foreign('field_id')->references('id')->on('fields')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('patrols', function(Blueprint $table) {
			$table->dropForeign('patrols_user_id_foreign');
		});
		Schema::table('patrols', function(Blueprint $table) {
			$table->dropForeign('patrols_transects_id_foreign');
		});
		Schema::table('mpas', function(Blueprint $table) {
			$table->dropForeign('mpas_datasheet_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_datasheet_id_foreign');
		});
		Schema::table('fields', function(Blueprint $table) {
			$table->dropForeign('fields_category_id_foreign');
		});
		Schema::table('transects', function(Blueprint $table) {
			$table->dropForeign('transects_mpa_id_foreign');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->dropForeign('tallies_patrol_id_foreign');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->dropForeign('tallies_field_id_foreign');
		});
	}
}