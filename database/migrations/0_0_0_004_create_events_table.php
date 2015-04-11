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
            $table->increments('id');
            $table->string('title');
            $table->text('details');
            $table->string('photo')->nullable();
            $table->integer('start_date');
            $table->integer('end_date');
            $table->string('location');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('interests');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');
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
