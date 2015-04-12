<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInterestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_interests', function(Blueprint $table)
		{
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('usr_id')->on('users');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('int_id')->on('interests');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_interests');
	}

}
