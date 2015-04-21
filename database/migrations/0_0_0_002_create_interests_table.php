<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interests', function(Blueprint $table)
		{
			$table->increments('int_id');
			$table->string('int_name');
			$table->string('int_image')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('cat_id')->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interests');
	}

}
