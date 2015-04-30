<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->increments('usr_id');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('usr_location');
            $table->string('sexe')->nullable();
            $table->integer('birthday')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('usr_photo')->nullable();
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
