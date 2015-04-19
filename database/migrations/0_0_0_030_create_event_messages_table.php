<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_messages', function(Blueprint $table)
		{
			$table->increments('eve_msg_id');
            $table->text('eve_message');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('usr_id')->on('users');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('eve_id')->on('events');
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
		Schema::drop('event_messages');
	}

}
