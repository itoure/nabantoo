<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Interest;
use App\Models\UserInterest;
use App\Models\User;
use App\Models\Location;
Use App\Models\UserLocation;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
	}

    /**
     * Show form to create an account
     *
     * @return Response
     */
    public function getCreate()
    {
        // get all interests from db
        $db_interests = Interest::with('category')->get();
        $arrInterests = array();
        foreach($db_interests as $interest){
            $arrInterests[$interest->category->cat_name][$interest->int_id] = $interest->int_name;
        }

        // params
        $data = new \stdClass();
        $data->interests = $arrInterests;

        return view('user/create')->with('data', $data);
    }


    /**
     * Valid the signup form and store datas in the DB
     *
     * @return Response
     */
    public function postStore()
    {
        $fileFolder = env('APP_FILE_FOLDER');

        $rules = array(
            'firstname' => 'required|alpha',
            'sexe' => 'required|alpha|size:1',
            'month' => 'required|integer',
            'day' => 'required|integer',
            'year' => 'required|integer',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'interests' => 'array',
            'location' => 'required|string',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('UserController@getCreate')->withErrors($validator)->withInput();
        } else {
            $firstname = Input::get('firstname');
            $sexe = Input::get('sexe');
            $month = Input::get('month');
            $day = Input::get('day');
            $year = Input::get('year');
            $email = Input::get('email');
            $location = Input::get('location');
            $password = Input::get('password');
            $interests = Input::get('interests');
            $photo = Input::file('photo');

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/user/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                }
            }


            // insert user
            $newUser = User::create(array(
                'firstname' => $firstname,
                'sexe' => $sexe,
                'birthday' => strtotime($month.'-'.$day.'-'.$year),
                'email' => $email,
                'password' => $password,
                'usr_photo' => $photoName,
                'usr_location' => $location
            ));


            // insert location
            $modelLocation = new Location();
            $location_id = $modelLocation->saveLocationsFromUserForm(Input::all());


            // insert user_location
            if($newUser->id && $location_id){
                UserLocation::create(array(
                    'user_id' => $newUser->usr_id,
                    'location_id' => $location_id,
                ));
            }

            // insert interests
            if($interests){
                foreach($interests as $interest){
                    UserInterest::create(array(
                        'user_id' => $newUser->usr_id,
                        'interest_id' => $interest,
                    ));
                }
            }

            return Redirect::action('DashboardController@getIndex');
        }

    }


	/**
	 * Show the user account details
	 *
	 * @return Response
	 */
	public function getAccount()
	{
		return view('user/account');
	}

}
