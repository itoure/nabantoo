<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInterest;
use App\Models\Event;
use App\Models\UserLocation;

class DashboardController extends Controller {

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
	 * Show the website home / dashboard
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        // get user_id
        $user_id = $this->request->user()->usr_id;

        // get user interests list
        $modUserInterest = new UserInterest();
        $arrUserInterests = $modUserInterest->getUserInterests($user_id);

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);

        //dd($arrUserInterests, $arrUserLocations);die;

        $arrEvents = array();
        if($arrUserInterests && $arrUserLocations) {
            // get events list
            $modelEvent = new Event();
            $eventsList = $modelEvent->getUserEventsByInterestsAndLocation(array_keys($arrUserInterests), $arrUserLocations);
            //dd($eventsList);

            foreach($eventsList as $event) {
                //dd($event);
                $objEvent = new \stdClass();
                $objEvent->id = $event->eve_id;
                $objEvent->title = $event->eve_title;
                $objEvent->details = $event->eve_details;
                $objEvent->location = $event->eve_location;
                $objEvent->start_date = $event->start_date;

                $arrEvents[] = $objEvent;
            }
        }


        $data = new \stdClass();
        $data->events = $arrEvents;

		return view('dashboard/index')->with('data', $data);
	}

}
