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
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the website home / dashboard
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
        // get user_id
        $user_id = $request->user()->id;

        // get user interests list
        $modUserInterest = new UserInterest();
        $arrUserInterests = $modUserInterest->getUserInterests($user_id);

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);

        //var_dump($arrUserInterests, $arrUserLocations);die;

        // get events list
        $modelEvent = new Event();
        $eventsList = $modelEvent->getUserEventsByInterestsAndLocation(array_keys($arrUserInterests), $arrUserLocations);
        //var_dump($eventsList);die;

        $arrEvents = array();
        foreach($eventsList as $event) {
            $objEvent = new \stdClass();
            $objEvent->title = $event->title;
            $objEvent->details = $event->details;
            $objEvent->location = $event->location;
            $objEvent->start_date = $event->start_date;

            $arrEvents[] = $objEvent;
        }

        $data = new \stdClass();
        $data->events = $arrEvents;

		return view('dashboard/index')->with('data', $data);
	}

}
