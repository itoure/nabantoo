<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_locations', function(Blueprint $table)
		{
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('usr_id')->on('users');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('loc_id')->on('locations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_locations');
	}

}
