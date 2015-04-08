<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Interest;
use App\Models\Country;
use App\Models\City;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CategoriesTableSeeder');
		$this->call('InterestsTableSeeder');
	}

}


class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        Category::create(['name' => 'Sport']);
        Category::create(['name' => 'Night']);
        Category::create(['name' => 'Game']);
        Category::create(['name' => 'Others']);
    }

}


class InterestsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('interests')->delete();

        Interest::create(['name' => 'Football', 'category_id' => 1]);
        Interest::create(['name' => 'Running', 'category_id' => 1]);
        Interest::create(['name' => 'Club', 'category_id' => 2]);
        Interest::create(['name' => 'Drink', 'category_id' => 2]);
        Interest::create(['name' => 'Dinner', 'category_id' => 2]);
        Interest::create(['name' => 'Poker', 'category_id' => 3]);
        Interest::create(['name' => 'Video Game', 'category_id' => 3]);
        Interest::create(['name' => 'Shopping', 'category_id' => 4]);
        Interest::create(['name' => 'Cinema', 'category_id' => 4]);
    }

}


class CitiesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cities')->delete();

        City::create(['name' => 'Lyon', 'country_id' => 1]);
        City::create(['name' => 'New York City', 'country_id' => 1]);
        City::create(['name' => 'Rio De Janeiro', 'country_id' => 1]);
        City::create(['name' => 'London', 'country_id' => 1]);
        City::create(['name' => 'Barcelona', 'country_id' => 1]);
    }

}

class CountriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('countries')->delete();

        Country::create(['name' => 'France']);
        Country::create(['name' => 'United States']);
        Country::create(['name' => 'China']);
        Country::create(['name' => 'Brazil']);
    }

}