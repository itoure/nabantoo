<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInterest;
use App\Models\Event;
use App\Models\UserLocation;

class HomeController extends Controller {

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
	 * Show the website home / dashboard
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        // get user_id
        $user_id = $this->request->user()->usr_id;
        $arrEvents = array();

        /*** Interesting ***/

        // get user interests list
        $modUserInterest = new UserInterest();
        $arrUserInterests = $modUserInterest->getUserInterests($user_id);

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);
        //dd($arrUserLocations);die;

        if($arrUserLocations) {
            // get events list
            $modelEvent = new Event();
            $eventsList = $modelEvent->getEventsByCountry($arrUserLocations[0]);
            //dd($arrUserLocations);die;

            foreach($eventsList as $event) {
                //dd($event);
                $objEvent = new \stdClass();
                $objEvent->id = $event->eve_id;
                $objEvent->title = $event->eve_title;
                $objEvent->details = $event->eve_details;
                $objEvent->location = $event->eve_location;
                $objEvent->start_date = date('d-m-Y', $event->start_date);
                $objEvent->event_owner = $event->firstname;
                $objEvent->usr_photo = $event->usr_photo;
                $objEvent->interest = $event->int_name;
                $objEvent->img_interest = $event->int_image;

                // if event loc match user loc
                $objEvent->aroundMe = false;
                if(($event->short_administrative_area_level_2 == $arrUserLocations[0]->short_administrative_area_level_2) ||
                ($event->short_administrative_area_level_1 == $arrUserLocations[0]->short_administrative_area_level_1)) {
                    $objEvent->aroundMe = true;
                }

                // if event cat match user cat
                $objEvent->fitToMe = false;
                if(in_array($event->int_name, $arrUserInterests)){
                    $objEvent->fitToMe = true;
                }

                $arrEvents[$event->eve_id] = $objEvent;
            }
        }


        /*** Upcoming ***/

        // get upcomming events for the current user
        $modEvent = new Event();
        $eventsList = $modEvent->getUpcommingEventsByUser($user_id);
        //dd($eventsList);

        foreach($eventsList as $event) {
            //dd($event);
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

            //$arrEvents[$event->eve_id] = $objEvent;
        }

        $data = new \stdClass();
        $data->events = $arrEvents;
        $data->my_events = array_slice($arrEvents, 0, 5);
        $data->userInterestsList = $arrUserInterests;

		return view('home/index')->with('data', $data);
	}

}
