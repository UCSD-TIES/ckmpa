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
			$table->foreign('location_id')->references('id')->on('locations')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('locations', function(Blueprint $table) {
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
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('location_id')->references('id')->on('locations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->foreign('patrol_id')->references('id')->on('patrols')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->foreign('section_id')->references('id')->on('sections')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->foreign('segment_id')->references('id')->on('segments')
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
			$table->dropForeign('patrols_location_id_foreign');
		});
		Schema::table('locations', function(Blueprint $table) {
			$table->dropForeign('locations_datasheet_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_datasheet_id_foreign');
		});
		Schema::table('fields', function(Blueprint $table) {
			$table->dropForeign('fields_category_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_location_id_foreign');
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->dropForeign('segments_patrol_id_foreign');
		});
		Schema::table('segments', function(Blueprint $table) {
			$table->dropForeign('segments_section_id_foreign');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->dropForeign('tallies_segment_id_foreign');
		});
		Schema::table('tallies', function(Blueprint $table) {
			$table->dropForeign('tallies_field_id_foreign');
		});
	}
}