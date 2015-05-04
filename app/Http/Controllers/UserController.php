<?php namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Interest;
use App\Models\UserInterest;
use App\Models\User;
use App\Models\Location;
Use App\Models\UserLocation;
use Illuminate\Http\Request;

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
	public function __construct(Request $request)
	{
        $this->middleware('auth');
        $this->request = $request;

        view()->composer('app', function($view)
        {
            $view->with('user', $this->request->user());
        });
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
            'interests' => 'array',
            'usr_location' => 'required|string',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('UserController@getAccount')->withErrors($validator)->withInput();
        } else {
            $firstname = Input::get('firstname');
            $sexe = Input::get('sexe');
            $month = Input::get('month');
            $day = Input::get('day');
            $year = Input::get('year');
            $location = Input::get('usr_location');
            $interests = Input::get('interests');
            $photo = Input::file('photo');
            $usr_id = Input::get('usr_id');
            $loc_id = Input::get('loc_id');

            // update user
            $user = User::findOrFail($usr_id);
            $user->firstname = $firstname;
            $user->sexe = $sexe;
            $user->birthday = strtotime($month.'/'.$day.'/'.$year);
            $user->usr_location = $location;

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/user/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                    $user->usr_photo = $photoName;
                }
            }

            $user->save();


            // delete then update
            UserLocation::where('user_id', '=', $usr_id)->delete();
            Location::findOrFail($loc_id)->delete();

            // update location
            $modelLocation = new Location();
            $location_id = $modelLocation->saveLocation(Input::all());

            // update user_location
            if($usr_id && $location_id){
                UserLocation::create(array(
                    'user_id' => $usr_id,
                    'location_id' => $location_id,
                ));
            }

            // update interests
            UserInterest::where('user_id', '=', $usr_id)->delete();
            if($interests){
                foreach($interests as $interest){
                    UserInterest::create(array(
                        'user_id' => $usr_id,
                        'interest_id' => $interest,
                    ));
                }
            }

            return Redirect::action('HomeController@getIndex');
        }

    }


	/**
	 * Show the user account details
	 *
	 * @return Response
	 */
	public function getAccount()
	{
        $user = $this->request->user();

        // get location
        $modUserLocation = new UserLocation();
        $arrLocations = $modUserLocation->getUserLocation($user->usr_id);
        //dd($arrLocations);

        // get user interest ids
        $dbUserInterest = new UserInterest();
        $arrUserInterestIds = $dbUserInterest->getUserInterestIds($user->usr_id);

        // get all interests
        $db_interests = Interest::with('category')->get();
        $arrInterests = array();
        foreach($db_interests as $interest){
            $arrInterests[$interest->category->cat_name][$interest->int_id] = $interest->int_name;
        }

        // get birthday
        $birthday = new \stdClass();
        $birthday->month = !empty($user->birthday) ? date('n', $user->birthday) : null;
        $birthday->day = !empty($user->birthday) ? date('j', $user->birthday) : null;
        $birthday->year = !empty($user->birthday) ? date('Y', $user->birthday) : null;


        // params
        $data = new \stdClass();
        $data->user = $user;
        $data->interests = $arrInterests;
        $data->interestIds = $arrUserInterestIds;
        $data->location = $arrLocations[0];
        $data->birthday = $birthday;

		return view('user/account')->with('data', $data);
	}


    public function getProfile($user_id) {

        // get complete user
        $modUser = new User();
        $user = $modUser->getCompleteUserById($user_id);
        //dd($user);

        // get user calendar
        $modEvent = new Event();
        $upcomingEvents = $modEvent->getUpcommingEventsByUser($user_id);

        $arrUpcomingEvents = array();
        foreach($upcomingEvents as $event) {
            $objEvent = new \stdClass();
            $objEvent->id = $event->eve_id;
            $objEvent->title = $event->eve_title;
            $objEvent->details = $event->eve_details;
            $objEvent->location = $event->eve_location;
            $objEvent->start_date = date('d-m-Y', $event->start_date);
            $objEvent->event_owner = $event->firstname;
            $objEvent->usr_photo = $event->usr_photo;
            $objEvent->type = 'upcoming';
            $objEvent->class = 'panel-primary';
            $objEvent->interest = $event->int_name;
            $objEvent->img_interest = $event->int_image;

            $arrUpcomingEvents[$event->eve_id] = $objEvent;
        }

        // get hosted events
        $arrHostEvents = $modEvent->getHostEventByUser($user_id);

        foreach($arrHostEvents as $event) {
            $event->start_date = date('d-m-Y', $event->start_date);
        }
        //dd($arrHostEvents);

        // params
        $data = new \stdClass();
        $data->user = $user;
        $data->upcomingEvents = $arrUpcomingEvents;
        $data->hostEvents = $arrHostEvents;

        return view('user/profile')->with('data', $data);

    }

}
