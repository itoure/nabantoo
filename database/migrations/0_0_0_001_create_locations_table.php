<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('short_sublocality_level_1')->nullable();
            $table->string('long_sublocality_level_1')->nullable();
            $table->string('short_locality')->nullable();
            $table->string('long_locality')->nullable();
            $table->string('short_administrative_area_level_2')->nullable();
            $table->string('long_administrative_area_level_2')->nullable();
            $table->string('short_administrative_area_level_1')->nullable();
            $table->string('long_administrative_area_level_1')->nullable();
            $table->string('short_postal_code')->nullable();
            $table->string('long_postal_code')->nullable();
            $table->string('short_postal_code_prefix')->nullable();
            $table->string('long_postal_code_prefix')->nullable();
            $table->string('short_country')->nullable();
            $table->string('long_country')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
