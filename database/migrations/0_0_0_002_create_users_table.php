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
            $table->string('usr_firstname');
            $table->string('usr_lastname')->nullable();
            $table->string('usr_location');
            $table->string('usr_phone');
            $table->string('usr_sexe')->nullable();
            $table->integer('usr_birthday')->nullable();
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
