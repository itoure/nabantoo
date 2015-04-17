<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\UserEvent;

class RendezvousController extends Controller {

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
	}

	/**
	 * Show form to create a rendez-vous
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // get all interests from db
        $db_interests = Interest::with('category')->get();
        $arrInterests = array('' => 'What is the plan ?');
        foreach($db_interests as $interest){
            $arrInterests[$interest->category->cat_name][$interest->int_id] = $interest->int_name;
        }

        $data = new \stdClass();
        $data->interests = $arrInterests;

		return view('rendezvous/create')->with('data', $data);
	}

    /**
     * Valid create rdv form and store datas in the DB
     *
     * @return Response
     */
    public function postStore()
    {
        // get user_id
        $user_id = $this->request->user()->usr_id;

        $fileFolder = env('APP_FILE_FOLDER');

        $rules = array(
            'title' => 'required|string',
            'details' => 'required|string',
            'location' => 'required|string',
            'photo' => 'image',
            'start_date' => 'required|date',
            'interest' => 'required|integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('RendezvousController@getCreate')->withErrors($validator)->withInput();
        } else {
            $title = Input::get('title');
            $details = Input::get('details');
            $location = Input::get('location');
            $photo = Input::file('photo');
            $start_date = Input::get('start_date');
            $interest = Input::get('interest');

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/event/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                }
            }

            // insert location
            $modelLocation = new Location();
            $location_id = $modelLocation->saveLocation(Input::all());

            Event::create(array(
                'eve_title' => $title,
                'eve_details' => $details,
                'eve_location' => $location,
                'eve_photo' => $photoName,
                'start_date' => strtotime($start_date),
                'interest_id' => $interest,
                'user_id' => $user_id,
                'location_id' => $location_id,
            ));

            return Redirect::action('DashboardController@getIndex');
        }

    }


    public function getJoinUserToEvent(){

        $params = $this->request->all();
        $user = $this->request->user();

        if(!empty($params['event_id'])){

            /*UserEvent::create(array(
                'user_id' => $user->usr_id,
                'event_id' => $params['event_id'],
            ));*/

            $return = array('response' => true);
            return response()->json($return);
        }

        $return = array('response' => false);
        return response()->json($return);

    }


    public function getFetchTabContentUpcomming() {

        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get upcomming events for the current user
        $modEvent = new Event();
        $eventsList = $modEvent->getUpcommingEventsByUser($user_id);
        //dd($eventsList);

        $arrEvents = array();
        foreach($eventsList as $event) {
            //dd($event);
            $objEvent = new \stdClass();
            $objEvent->id = $event->eve_id;
            $objEvent->title = $event->eve_title;
            $objEvent->details = $event->eve_details;
            $objEvent->location = $event->eve_location;
            $objEvent->start_date = $event->start_date;
            $objEvent->event_owner = $event->firstname;

            $arrEvents[] = $objEvent;
        }

        $data = new \stdClass();
        $data->events = $arrEvents;

        $html = view('dashboard/rdvlist')->with('data', $data)->render();
        $response = array(
            'html' => $html
        );

        $return = array(
            'response' => true,
            'data' => $response
        );

        return response()->json($return);

    }


    public function getFetchTabContentInteresting() {

        // get user_id
        $user_id = $this->request->user()->usr_id;

    }


    public function getFetchTabContentFriends() {

        // get user_id
        $user_id = $this->request->user()->usr_id;

    }


    public function getDetails($event_id){

        $modEvent = new Event();
        $event = $modEvent->getCompleteEventById($event_id);

        $objEvent = new \stdClass();
        $objEvent->id = $event->eve_id;
        $objEvent->title = $event->eve_title;
        $objEvent->details = $event->eve_details;
        $objEvent->location = $event->eve_location;
        $objEvent->start_date = date('d-m-Y', $event->start_date);
        $objEvent->event_owner = $event->firstname;
        $objEvent->interest = $event->int_name;

        $data = new \stdClass();
        $data->event = $objEvent;

        return view('rendezvous/details')->with('data', $data);

    }

}
