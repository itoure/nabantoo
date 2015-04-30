<?php namespace App\Services;

use App\Models\Location;
use App\Models\UserLocation;
//use App\Models\User;
use App\Models\UserInterest;
use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
            //'sexe' => 'required|alpha|size:1',
            'firstname' => 'required|alpha',
            'location' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            //'month' => 'required|integer',
            //'day' => 'required|integer',
            //'year' => 'required|integer',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user =  User::create([
            'firstname' => $data['firstname'],
            //'sexe' => $data['sexe'],
            //'birthday' => strtotime($data['month'].'/'.$data['day'].'/'.$data['year']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'usr_location' => $data['location'],
            'usr_photo' => 'anonymous.png'
		]);

        // insert location
        $modelLocation = new Location();
        $location_id = $modelLocation->saveLocation($data);

        // insert user_location
        if($user->usr_id && $location_id){
            UserLocation::create(array(
                'user_id' => $user->usr_id,
                'location_id' => $location_id,
            ));
        }

        // insert interests
        if($data['interests']){
            foreach($data['interests'] as $interest){
                UserInterest::create(array(
                    'user_id' => $user->usr_id,
                    'interest_id' => $interest,
                ));
            }
        }

        return $user;
	}

}
