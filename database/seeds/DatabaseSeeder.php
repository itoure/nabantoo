<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Interest;
use App\Models\UserInterest;
use App\User;
use App\Models\Location;
use App\Models\UserLocation;
use App\Models\Event;
use App\Models\UserEvent;

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
		$this->call('UsersTableSeeder');
		$this->call('UserInterestsTableSeeder');
		$this->call('LocationsTableSeeder');
		$this->call('UserLocationsTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('UserEventsTableSeeder');
	}

}


class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        Category::create(['cat_name' => 'Sports']);
        Category::create(['cat_name' => 'Sorties']);
        Category::create(['cat_name' => 'Jeux']);
        Category::create(['cat_name' => 'Enfants']);
    }

}


class InterestsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('interests')->delete();

        Interest::create(['int_name' => 'Football', 'int_image' => 'football.jpg',  'category_id' => 1]);
        Interest::create(['int_name' => 'Jogging', 'int_image' => 'jogging.jpg', 'category_id' => 1]);
        Interest::create(['int_name' => 'Basketball', 'category_id' => 1]);
        Interest::create(['int_name' => 'Marche', 'category_id' => 1]);
        Interest::create(['int_name' => 'Badminton', 'category_id' => 1]);
        Interest::create(['int_name' => 'Tennis', 'category_id' => 1]);
        Interest::create(['int_name' => 'Tennis de table', 'category_id' => 1]);
        Interest::create(['int_name' => 'Squash', 'category_id' => 1]);
        Interest::create(['int_name' => 'Natation', 'category_id' => 1]);
        Interest::create(['int_name' => 'Ski', 'category_id' => 1]);
        Interest::create(['int_name' => 'Rugby', 'category_id' => 1]);
        Interest::create(['int_name' => 'Velo', 'category_id' => 1]);
        Interest::create(['int_name' => 'Fitness', 'category_id' => 1]);
        Interest::create(['int_name' => 'Musculation', 'category_id' => 1]);
        Interest::create(['int_name' => 'Escalade', 'category_id' => 1]);
        Interest::create(['int_name' => 'Golf', 'category_id' => 1]);
        Interest::create(['int_name' => 'Pêche', 'category_id' => 1]);
        Interest::create(['int_name' => 'Boite de nuit', 'int_image' => 'clubbing.jpg', 'category_id' => 2]);
        Interest::create(['int_name' => 'Bar', 'category_id' => 2]);
        Interest::create(['int_name' => 'Restaurant', 'int_image' => 'restaurant.jpg', 'category_id' => 2]);
        Interest::create(['int_name' => 'After work', 'category_id' => 2]);
        Interest::create(['int_name' => 'Cinema', 'category_id' => 2]);
        Interest::create(['int_name' => 'Bowling', 'category_id' => 2]);
        Interest::create(['int_name' => 'Poker', 'category_id' => 3]);
        Interest::create(['int_name' => 'Jeux videos', 'category_id' => 3]);
        Interest::create(['int_name' => 'Shopping', 'int_image' => 'shopping.jpg', 'category_id' => 3]);
        Interest::create(['int_name' => 'Chicha', 'category_id' => 3]);
        Interest::create(['int_name' => 'Brunch', 'category_id' => 3]);
        Interest::create(['int_name' => 'Pique-nique', 'category_id' => 3]);
        Interest::create(['int_name' => 'Parc', 'category_id' => 4]);
        Interest::create(['int_name' => 'Gouter', 'category_id' => 4]);
    }

}


class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'firstname' => 'Ibou',
            'usr_location' => 'Lyon, France',
            'sexe' => 'M',
            'birthday' => 1066348800,
            'email' => 'ib.toure@gmail.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'firstname' => 'Zlatan',
            'usr_location' => 'Paris, France',
            'sexe' => 'M',
            'birthday' => 1066348800,
            'email' => 'zlatan.ibra@psg.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'firstname' => 'Sean Carter',
            'usr_location' => 'New York, État de New York, États-Unis',
            'sexe' => 'M',
            'birthday' => 1066348800,
            'email' => 'jayz@nyc.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'firstname' => 'Eva Mendes',
            'usr_location' => 'Lyon, France',
            'sexe' => 'F',
            'birthday' => 1066348800,
            'email' => 'eva.mendes@ol.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'firstname' => 'Rihanna',
            'usr_location' => 'Marseille, France',
            'sexe' => 'F',
            'birthday' => 1066348800,
            'email' => 'rihanna@ol.net',
            'password' => bcrypt('123456')
        ]);
    }

}


class UserInterestsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_interests')->delete();

        UserInterest::create([
            'user_id' => '1',
            'interest_id' => '1',
        ]);
        UserInterest::create([
            'user_id' => '1',
            'interest_id' => '2',
        ]);
        UserInterest::create([
            'user_id' => '1',
            'interest_id' => '3',
        ]);
        UserInterest::create([
            'user_id' => '2',
            'interest_id' => '4',
        ]);
        UserInterest::create([
            'user_id' => '2',
            'interest_id' => '5',
        ]);
        UserInterest::create([
            'user_id' => '2',
            'interest_id' => '6',
        ]);
        UserInterest::create([
            'user_id' => '3',
            'interest_id' => '7',
        ]);
        UserInterest::create([
            'user_id' => '3',
            'interest_id' => '8',
        ]);
        UserInterest::create([
            'user_id' => '3',
            'interest_id' => '9',
        ]);
        UserInterest::create([
            'user_id' => '4',
            'interest_id' => '10',
        ]);
        UserInterest::create([
            'user_id' => '4',
            'interest_id' => '11',
        ]);
        UserInterest::create([
            'user_id' => '4',
            'interest_id' => '12',
        ]);
        UserInterest::create([
            'user_id' => '5',
            'interest_id' => '13',
        ]);
        UserInterest::create([
            'user_id' => '5',
            'interest_id' => '14',
        ]);
        UserInterest::create([
            'user_id' => '5',
            'interest_id' => '15',
        ]);
    }

}


class LocationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('locations')->delete();

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Lyon',
            'short_administrative_area_level_2' => '69',
            'short_administrative_area_level_1' => 'RA',
        ]);

        Location::create([
            'short_locality' => 'Paris',
            'short_administrative_area_level_2' => '75',
            'short_administrative_area_level_1' => 'IDF',
        ]);

        Location::create([
            'short_locality' => 'NY',
            'short_administrative_area_level_2' => '',
            'short_administrative_area_level_1' => 'NY',
        ]);

        Location::create([
            'short_locality' => 'Marseille',
            'short_administrative_area_level_2' => '13',
            'short_administrative_area_level_1' => 'PACA',
        ]);

    }

}


class UserLocationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_locations')->delete();

        UserLocation::create([
            'user_id' => '1',
            'location_id' => '1',
        ]);
        UserLocation::create([
            'user_id' => '2',
            'location_id' => '2',
        ]);
        UserLocation::create([
            'user_id' => '3',
            'location_id' => '3',
        ]);
        UserLocation::create([
            'user_id' => '4',
            'location_id' => '5',
        ]);
        UserLocation::create([
            'user_id' => '5',
            'location_id' => '4',
        ]);
    }

}


class EventsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('events')->delete();

        Event::create([
            'eve_title' => 'Soccer 5v5',
            'eve_details' => 'Match de foot 5v5 au soccer five de Parilly',
            'start_date' => time(),
            'eve_location' => 'Lyon, France',
            'interest_id' => '1',
            'user_id' => '1',
            'location_id' => '6',
        ]);

        Event::create([
            'eve_title' => 'Soirée disco au Macumba',
            'eve_details' => 'Préparer vous à enflammer la piste de danse sur des sons des années 80',
            'start_date' => time(),
            'eve_location' => 'Paris, France',
            'interest_id' => '18',
            'user_id' => '2',
            'location_id' => '7',
        ]);

        Event::create([
            'eve_title' => 'Shopping sur la 5eme aveneue',
            'eve_details' => 'Salut les filles! Partantes pour une après-midi shopping',
            'start_date' => time(),
            'eve_location' => 'New York, État de New York, États-Unis',
            'interest_id' => '26',
            'user_id' => '3',
            'location_id' => '8',
        ]);

        Event::create([
            'eve_title' => 'Restaurant sur le vieux port',
            'eve_details' => 'Venez decouvrir avec moi le nouveau restaurant branché sur le vieux port',
            'start_date' => time(),
            'eve_location' => 'Marseille, France',
            'interest_id' => '20',
            'user_id' => '5',
            'location_id' => '9',
        ]);

        Event::create([
            'eve_title' => 'Petit jogging aux parc de la tête d\'or',
            'eve_details' => 'Sur un rythme cool biensur...',
            'start_date' => time(),
            'eve_location' => 'Lyon, France',
            'interest_id' => '2',
            'user_id' => '4',
            'location_id' => '10',
        ]);
    }

}


class UserEventsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_events')->delete();

        UserEvent::create([
            'user_id' => '1',
            'event_id' => '2'
        ]);
    }

}