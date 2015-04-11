<?php namespace App\Services;

use App\User;
//Use App\Models\User;
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
            'sexe' => 'required|alpha|size:1',
            'firstname' => 'required|alpha',
            'location' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'month' => 'required|integer',
            'day' => 'required|integer',
            'year' => 'required|integer',
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
		return User::create([
            'firstname' => $data['firstname'],
            'sexe' => $data['sexe'],
            'birthday' => strtotime($data['month'].'-'.$data['day'].'-'.$data['year']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'location' => $data['location']
		]);
	}

}
