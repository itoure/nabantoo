<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
            $table->increments('eve_id');
            $table->string('eve_title');
            $table->text('eve_details');
            $table->string('eve_photo')->nullable();
            $table->integer('eve_people_limit_min')->default(0);
            $table->integer('eve_people_limit_max')->default(0);
            $table->float('eve_budget');
            $table->integer('eve_duration');
            $table->string('eve_location');
            $table->string('eve_meeting_point');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('int_id')->on('interests');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('usr_id')->on('users');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('loc_id')->on('locations');
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
		Schema::drop('events');
	}

}
