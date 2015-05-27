<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_dates', function(Blueprint $table)
		{
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('eve_id')->on('events');
            $table->integer('eve_start_date');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_dates');
	}

}
