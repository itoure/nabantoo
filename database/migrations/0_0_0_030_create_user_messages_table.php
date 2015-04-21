<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_messages', function(Blueprint $table)
		{
			$table->increments('usr_msg_id');
            $table->text('usr_message');
            $table->integer('from_id')->unsigned();
            $table->foreign('from_id')->references('usr_id')->on('users');
            $table->integer('to_id')->unsigned();
            $table->foreign('to_id')->references('usr_id')->on('users');
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
		Schema::drop('user_messages');
	}

}
