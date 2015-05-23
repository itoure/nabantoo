<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_networks', function(Blueprint $table)
		{
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('usr_id')->on('users');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('usr_id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_networks');
	}

}
