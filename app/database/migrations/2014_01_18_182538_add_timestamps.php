<?php

use Illuminate\Database\Migrations\Migration;

class AddTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('coastkeeper_datasheet', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_datasheet_category', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_datasheet_entry', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_section', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_volunteer', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_location', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_patrol', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_patrol_entry', function($table)
		{
			$table->timestamps();
		});

		Schema::table('coastkeeper_patrol_tally', function($table)
		{
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
		Schema::table('coastkeeper_datasheet', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_datasheet_category', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_datasheet_entry', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_section', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_volunteer', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_location', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_patrol', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_patrol_entry', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('coastkeeper_patrol_tally', function($table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});
	}

}