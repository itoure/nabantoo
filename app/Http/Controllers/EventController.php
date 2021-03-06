<?php namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\UserEvent;
use App\Models\EventMessage;
use App\Models\UserLocation;
use App\Models\UserInterest;
use App\Models\EventDate;

class EventController extends Controller {

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

		return view('event/create')->with('data', $data);
	}


    /**
     * Show form to edit a event
     *
     * @return Response
     */
    public function getEdit($event_id)
    {
        // get complete event
        $modEvent = new Event();
        $event = $modEvent->getCompleteEventById($event_id);

        $event->eve_start_date = date('d M H:i', $event->eve_start_date);

        // get all interests from db
        $db_interests = Interest::with('category')->get();
        $arrInterests = array('' => 'What is the plan ?');
        foreach($db_interests as $interest){
            $arrInterests[$interest->category->cat_name][$interest->int_id] = $interest->int_name;
        }

        // get location
        $eventLocation = Location::findOrFail($event->location_id);

        $data = new \stdClass();
        $data->event = $event;
        $data->interests = $arrInterests;
        $data->location = $eventLocation;

        return view('event/edit')->with('data', $data);
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
            'people_limit_max' => 'integer',
            'budget' => 'integer',
            'duration' => 'integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('EventController@getCreate')->withErrors($validator)->withInput();
        } else {
            $title = Input::get('title');
            $details = Input::get('details');
            $location = Input::get('location');
            $photo = Input::file('photo');
            $start_date = Input::get('start_date');
            $interest = Input::get('interest');
            $people_limit_max = Input::get('people_limit_max');
            $budget = Input::get('budget');
            $duration = Input::get('duration');

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/event/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                }
            }

            // create location
            $modelLocation = new Location();
            $location_id = $modelLocation->saveLocation(Input::all());

            // create event
            $newEvent = Event::create(array(
                'eve_title' => $title,
                'eve_details' => $details,
                'eve_location' => $location,
                'eve_photo' => $photoName,
                'eve_people_limit_max' => $people_limit_max,
                'eve_budget' => $budget,
                'eve_duration' => $duration,
                'interest_id' => $interest,
                'user_id' => $user_id,
                'location_id' => $location_id,
            ));

            // create user event
            UserEvent::create(array(
                'user_id' => $user_id,
                'event_id' => $newEvent->eve_id,
                'user_event_choice' => 'host'
            ));

            // create event date
            EventDate::create(array(
                'event_id' => $newEvent->eve_id,
                'eve_start_date' => strtotime($start_date)
            ));

            return Redirect::action('HomeController@getIndex');
        }

    }


    public function postEditStore(){

        $fileFolder = env('APP_FILE_FOLDER');

        $rules = array(
            'eve_title' => 'required|string',
            'eve_details' => 'required|string',
            'eve_location' => 'required|string',
            'photo' => 'image',
            'eve_start_date' => 'required',
            'interest' => 'required|integer',
            'eve_people_limit_max' => 'integer',
            'eve_budget' => 'numeric',
            'eve_duration' => 'integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('EventController@getEdit', array('event_id' => Input::get('eve_id')))->withErrors($validator)->withInput();
        } else {
            $title = Input::get('eve_title');
            $details = Input::get('eve_details');
            $location = Input::get('eve_location');
            $photo = Input::file('photo');
            $start_date = Input::get('eve_start_date');
            $interest = Input::get('interest');
            $people_limit_max = Input::get('eve_people_limit_max');
            $budget = Input::get('eve_budget');
            $duration = Input::get('eve_duration');
            $event_id = Input::get('eve_id');
            $location_id = Input::get('location_id');


            // update event
            $event = Event::findOrFail($event_id);
            $event->eve_title = $title;
            $event->eve_details = $details;
            $event->eve_location = $location;
            $event->eve_people_limit_max = $people_limit_max;
            $event->eve_budget = $budget;
            $event->eve_duration = $duration;
            $event->interest_id = $interest;

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/event/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                    $event->eve_photo = $photoName;
                }
            }

            // create new location
            $modelLocation = new Location();
            $location_id_new = $modelLocation->saveLocation(Input::all());
            $event->location_id = $location_id_new;

            // update event date
            $event_date = EventDate::where('event_id', '=', $event_id)->first();
            //$event_date->eve_start_date = strtotime($start_date);
            $event_date->save();


            // save event
            $event->save();


            Location::findOrFail($location_id)->delete();

            return Redirect::action('HomeController@getIndex');
        }

    }

    public function getCancelJoinUserToEvent(){

        $params = $this->request->all();
        $user = $this->request->user();

        if(!empty($params['event_id'])){

            UserEvent::where('user_id', '=', $user->usr_id)->where('event_id', '=', $params['event_id'])->delete();

            $return = array('response' => true);
            return response()->json($return);
        }

        $return = array('response' => false);
        return response()->json($return);

    }


    public function getJoinUserToEvent(){

        $params = $this->request->all();
        $user = $this->request->user();

        if(!empty($params['event_id'])){

            UserEvent::create(array(
                'user_id' => $user->usr_id,
                'event_id' => $params['event_id'],
                'user_event_choice' => 'ok'
            ));

            $return = array('response' => true);
            return response()->json($return);
        }

        $return = array('response' => false);
        return response()->json($return);

    }


    public function getDeclineUserToEvent(){

        $params = $this->request->all();
        $user = $this->request->user();

        if(!empty($params['event_id'])){

            UserEvent::create(array(
                'user_id' => $user->usr_id,
                'event_id' => $params['event_id'],
                'user_event_choice' => 'ko'
            ));

            $return = array('response' => true);
            return response()->json($return);
        }

        $return = array('response' => false);
        return response()->json($return);

    }


    public function getDetails($event_id){

        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get event
        $modEvent = new Event();
        $event = $modEvent->getCompleteEventById($event_id);
        //dd($event);

        // count people for an event
        $count_participants = $modEvent->countParticipantsByEvent($event_id);

        // create event object
        $event->eve_start_date = date('d M H:i', $event->eve_start_date);
        $event->count_participants = $count_participants;

        $modUser = new User();
        $event->isUserInMyNetwork = $modUser->isUserInMyNetwork($user_id, $event->usr_id);

        // get all messages
        $arrMessages = $this->_getAllMessages($event->eve_id);

        // get first letter
        $event->usr_first_letter = strtoupper($event->usr_firstname[0]);

        $event->user_event_choice = $modEvent->getEventStatus($event->eve_id, $user_id);

        $data = new \stdClass();
        $data->event = $event;
        $data->eventsListByInterest = $this->_fetchEventsListByInterest($event->int_id, $event->eve_id);
        $data->messages = $arrMessages;
        $data->user_id = $user_id;

        return view('event/details')->with('data', $data);

    }


    protected function _getAllMessages($event_id){

        $modEvent = new Event();
        $messages = $modEvent->getAllMessagesByEvent($event_id);
        $arrMessages = array();
        foreach($messages as $msg){
            $objMessage = new \stdClass();
            $objMessage->user_photo = $msg->usr_photo;
            $objMessage->message = $msg->eve_message;
            $objMessage->date = $msg->created_at;
            $objMessage->usr_first_letter = strtoupper($msg->usr_firstname[0]);
            $arrMessages[] = $objMessage;
        }

        return $arrMessages;

    }


    public function postStoreMessage() {

        $rules = array(
            'message' => 'required|string',
            'user_id' => 'required|integer',
            'event_id' => 'required|integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $message = Input::get('message');
            $user_id = Input::get('user_id');
            $event_id = Input::get('event_id');

            EventMessage::create(array(
                'eve_message' => $message,
                'user_id' => $user_id,
                'event_id' => $event_id,
            ));

            return redirect()->back();

        }

    }


    public function getFetchMyNextEvents() {

        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get upcomming events for the current user
        $modEvent = new Event();
        $eventsList = $modEvent->getUpcommingEventsByUser($user_id);
        //dd($eventsList);

        foreach($eventsList as $event) {
            //dd($event);
            $event->eve_start_date = date('d M H:i', $event->eve_start_date);
            $event->usr_first_letter = strtoupper($event->usr_firstname[0]);
        }

        $html = view('event/event_items_sidebar')->with('events', $eventsList)->render();

        $response = array(
            'html' => $html
        );
        $return = array(
            'response' => true,
            'data' => $response
        );

        return response()->json($return);

    }


    public function getFetchMySuggestedMoments() {

        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get upcomming events for the current user
        $modEvent = new Event();

        // get user interests list
        $modUserInterest = new UserInterest();
        $arrUserInterestsIds = $modUserInterest->getUserInterestIds($user_id);

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);

        $arrAnsEventIds = $modEvent->getEventsIdsByUserAndStatus($user_id);

        // get events list
        $eventsList = $modEvent->getUserEventsByInterestsAndLocation($arrUserInterestsIds, $arrUserLocations[0], $arrAnsEventIds);

        foreach($eventsList as $event) {
            //dd($event);
            $event->eve_start_date = date('d M H:i', $event->eve_start_date);
            $event->usr_first_letter = strtoupper($event->usr_firstname[0]);
        }

        $html = view('event/event_items_sidebar')->with('events', $eventsList)->render();

        $response = array(
            'html' => $html
        );
        $return = array(
            'response' => true,
            'data' => $response
        );

        return response()->json($return);

    }


    protected function _fetchParticipantsListByEvent($event_id) {

        $modEvent = new Event();
        $participantsList = $modEvent->getParticipantsByEvent($event_id);
        //dd($participantsList);

        foreach($participantsList as $participant) {
            $participant->usr_first_letter = strtoupper($participant->usr_firstname[0]);
        }

        return $participantsList;

    }


    protected function _fetchEventsListByInterest($interest_id, $event_id) {

        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);

        $modEvent = new Event();
        $eventsList = $modEvent->getEventsByInterest($interest_id, $event_id, $arrUserLocations[0]);

        foreach($eventsList as $event) {
            $event->eve_start_date = date('d M H:i', $event->eve_start_date);
        }

        return $eventsList;

    }


    public function getFetchEventParticipants() {

        $params = $this->request->all();
        $participantsList = $this->_fetchParticipantsListByEvent($params['event_id']);

        $data = new \stdClass();
        $data->participantsList = $participantsList;
        $html = view('event/event_participants')->with('data', $data)->render();
        $response = array(
            'html' => $html
        );
        $return = array(
            'response' => true,
            'data' => $response
        );

        return response()->json($return);

    }

    public function getFetchEventCountParticipants() {

        $params = $this->request->all();

        // count people for an event
        $modEvent = new Event();
        $count_participants = $modEvent->countParticipantsByEvent($params['event_id']);

        $return = array(
            'response' => true,
            'data' => $count_participants
        );

        return response()->json($return);

    }


    public function getFetchEventListHome() {

        $params = $this->request->all();
        $filter = $params['filter'];

        // get user_id
        $user_id = $this->request->user()->usr_id;
        $user_firstname = $this->request->user()->usr_firstname;

        // get upcomming events for the current user
        $modEvent = new Event();
        $arrAnsEventIds = $modEvent->getEventsIdsByUserAndStatus($user_id);

        switch($filter){

            case 'fitToMe':
                // get user interests list
                $modUserInterest = new UserInterest();
                $arrUserInterestsIds = $modUserInterest->getUserInterestIds($user_id);

                // get events list
                $eventsList = $modEvent->getEventsByUserInterests($arrUserInterestsIds, $arrAnsEventIds);
                break;

            case 'aroundMe':
                // get user location
                $modUserLocation = new UserLocation();
                $arrUserLocations = $modUserLocation->getUserLocation($user_id);

                // get events list
                $eventsList = $modEvent->getEventsByUserLocation($arrUserLocations[0], $arrAnsEventIds);
                break;

            case 'perfectMatch':
                // get user interests list
                $modUserInterest = new UserInterest();
                $arrUserInterestsIds = $modUserInterest->getUserInterestIds($user_id);

                // get user location
                $modUserLocation = new UserLocation();
                $arrUserLocations = $modUserLocation->getUserLocation($user_id);

                // get events list
                $eventsList = $modEvent->getUserEventsByInterestsAndLocation($arrUserInterestsIds, $arrUserLocations[0], $arrAnsEventIds);
                break;

            case 'myNetwork':
                $modUser = new User();
                $arrMemberIds = $modUser->getNetworkMemberIdByUser($user_id);

                $eventsList = $modEvent->getEventsInNetwork($arrMemberIds);

                break;

            case 'myMoments':
                $eventsList = $modEvent->getUpcommingEventsByUser($user_id);
                break;

            default:

                $arrDeclinedEventIds = $modEvent->getEventsIdsByUserAndStatus($user_id, 'ko');

                // get user location
                $modUserLocation = new UserLocation();
                $arrUserLocations = $modUserLocation->getUserLocation($user_id);

                // get events list
                $eventsList = $modEvent->getEventsByCountry($arrUserLocations[0], $arrDeclinedEventIds);
        }

        if(!empty($eventsList)) {

            foreach($eventsList as $event) {
                //dd($event);
                $event->eve_start_date = date('d M H:i', $event->eve_start_date);
                $event->usr_first_letter = strtoupper($event->usr_firstname[0]);

                $event->user_event_choice = $modEvent->getEventStatus($event->eve_id, $user_id);

                // count people for the event
                $event->count_people = $modEvent->countParticipantsByEvent($event->eve_id);
            }
        }

        $data = new \stdClass();
        $data->events = $eventsList;

        $html = view('event/event_items')->with('events', $data->events)->render();
        $response = array(
            'html' => $html
        );

        $return = array(
            'response' => true,
            'data' => $response
        );

        return response()->json($return);

    }

}
