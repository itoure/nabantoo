<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Interest;

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

        Category::create(['cat_name' => 'Sport']);
        Category::create(['cat_name' => 'Night']);
        Category::create(['cat_name' => 'Game']);
        Category::create(['cat_name' => 'Others']);
    }

}


class InterestsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('interests')->delete();

        Interest::create(['int_name' => 'Football', 'category_id' => 1]);
        Interest::create(['int_name' => 'Running', 'category_id' => 1]);
        Interest::create(['int_name' => 'Club', 'category_id' => 2]);
        Interest::create(['int_name' => 'Drink', 'category_id' => 2]);
        Interest::create(['int_name' => 'Dinner', 'category_id' => 2]);
        Interest::create(['int_name' => 'Poker', 'category_id' => 3]);
        Interest::create(['int_name' => 'Video Game', 'category_id' => 3]);
        Interest::create(['int_name' => 'Shopping', 'category_id' => 4]);
        Interest::create(['int_name' => 'Cinema', 'category_id' => 4]);
    }

}