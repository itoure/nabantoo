<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\UserEvent;
use App\Models\EventMessage;

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
            return Redirect::action('EventController@getCreate')->withErrors($validator)->withInput();
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

            return Redirect::action('HomeController@getIndex');
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



    public function getDetails($event_id){

        // get user_id
        $current_user_id = $this->request->user()->usr_id;

        // get event
        $modEvent = new Event();
        $event = $modEvent->getCompleteEventById($event_id);

        // count people for an event
        $count_people = $modEvent->countPeopleByEvent($event_id);

        // create event object
        $objEvent = new \stdClass();
        $objEvent->id = $event->eve_id;
        $objEvent->title = $event->eve_title;
        $objEvent->details = $event->eve_details;
        $objEvent->location = $event->eve_location;
        $objEvent->start_date = date('d-m-Y', $event->start_date);
        $objEvent->event_owner = $event->firstname;
        $objEvent->usr_photo = $event->usr_photo;
        $objEvent->user_id = $event->usr_id;
        $objEvent->interest = $event->int_name;
        $objEvent->count_people = $count_people;
        //$objEvent->people_limit = $event->people_limit;

        // get all messages
        $messages = $modEvent->getAllMessagesByEvent($event_id);
        $arrMessages = array();
        foreach($messages as $msg){
            $objMessage = new \stdClass();
            $objMessage->user_photo = $msg->usr_photo;
            $objMessage->message = $msg->eve_message;
            $objMessage->date = $msg->created_at;
            $arrMessages[] = $objMessage;
        }

        $data = new \stdClass();
        $data->event = $objEvent;
        $data->messages = $arrMessages;
        $data->current_user_id = $current_user_id;

        return view('event/details')->with('data', $data);

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

}
