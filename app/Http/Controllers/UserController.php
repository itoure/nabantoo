<?php namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserNetwork;
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
            'usr_firstname' => 'required|alpha',
            'usr_sexe' => 'required|alpha|size:1',
            'interests' => 'array',
            'usr_location' => 'required|string',
            'usr_phone' => 'numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('UserController@getAccount')->withErrors($validator)->withInput();
        } else {
            $firstname = Input::get('usr_firstname');
            $sexe = Input::get('usr_sexe');
            $month = Input::get('month');
            $day = Input::get('day');
            $year = Input::get('year');
            $location = Input::get('usr_location');
            $interests = Input::get('interests');
            $photo = Input::file('photo');
            $phone = Input::get('usr_phone');
            $usr_id = Input::get('usr_id');
            $loc_id = Input::get('loc_id');

            // update user
            $user = User::findOrFail($usr_id);
            $user->usr_firstname = $firstname;
            $user->usr_sexe = $sexe;
            $user->usr_birthday = strtotime($month.'/'.$day.'/'.$year);
            $user->usr_location = $location;
            $user->usr_phone = $phone;

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

            return Redirect::action('UserController@getProfile', array('user_id' => $usr_id));
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
        $birthday->month = !empty($user->usr_birthday) ? date('n', $user->usr_birthday) : null;
        $birthday->day = !empty($user->usr_birthday) ? date('j', $user->usr_birthday) : null;
        $birthday->year = !empty($user->usr_birthday) ? date('Y', $user->usr_birthday) : null;

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

        // get user_id
        $current_user_id = $this->request->user()->usr_id;

        // get complete user
        $modUser = new User();
        $user = $modUser->getCompleteUserById($user_id);
        //dd($user);

        $user->usr_first_letter = strtoupper($user->usr_firstname[0]);

        // get user calendar
        $modEvent = new Event();

        $arrHostEventIds = $modEvent->getEventsIdsByUserAndStatus($user_id, 'host');

        $upcomingEvents = $modEvent->getUpcommingEventsByUser($user_id, $arrHostEventIds);
        foreach($upcomingEvents as $event) {
            $event->eve_start_date = date('d M H:i', $event->eve_start_date);
            $event->usr_first_letter = strtoupper($event->usr_firstname[0]);

            // count people for the event
            $event->count_people = $modEvent->countParticipantsByEvent($event->eve_id);
        }

        // get hosted events
        $arrHostEvents = $modEvent->getHostEventByUser($user_id);
        foreach($arrHostEvents as $event) {
            $event->eve_start_date = date('d M H:i', $event->eve_start_date);
            $event->usr_first_letter = strtoupper($event->usr_firstname[0]);

            $event->user_event_choice = $modEvent->getEventStatus($event->eve_id, $user_id);

            // count people for the event
            $event->count_people = $modEvent->countParticipantsByEvent($event->eve_id);
        }
        //dd($arrHostEvents);

        // is user is in network
        $user->isUserInMyNetwork = $modUser->isUserInMyNetwork($current_user_id, $user_id);

        // params
        $data = new \stdClass();
        $data->user = $user;
        $data->upcomingEvents = $upcomingEvents;
        $data->hostEvents = $arrHostEvents;
        $data->user_id = $current_user_id;

        return view('user/profile')->with('data', $data);

    }


    public function getManageNetwork() {

        $params = $this->request->all();
        $user = $this->request->user();

        $user_id = $params['user_id'];
        $action = $params['action'];

        if($user_id && $action){

            if($action == 'add'){
                UserNetwork::create(array(
                    'user_id' => $user->usr_id,
                    'member_id' => $user_id,
                ));
            }
            else{
                UserNetwork::where('user_id', '=', $user->usr_id)->where('member_id', '=', $user_id)->delete();
            }

            $return = array('response' => true);
            return response()->json($return);
        }

        $return = array('response' => false);
        return response()->json($return);
    }
}
