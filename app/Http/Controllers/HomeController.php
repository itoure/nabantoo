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
        $user_firstname = $this->request->user()->usr_firstname;

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
                $event->eve_start_date = date('d M H:i', $event->eve_start_date);
                $event->usr_first_letter = strtoupper($event->usr_firstname[0]);

                //get user upcoming event
                $event->isUserComing = $this->_isUserComingToEvent($user_id, $event->eve_id);

                // count people for the event
                $event->count_people = $modelEvent->countPeopleByEvent($event->eve_id);

                // if event loc match user loc
                $event->aroundMe = false;
                if(($event->short_administrative_area_level_2 == $arrUserLocations[0]->short_administrative_area_level_2) ||
                ($event->short_administrative_area_level_1 == $arrUserLocations[0]->short_administrative_area_level_1)) {
                    $event->aroundMe = true;
                }

                // if event cat match user cat
                $event->fitToMe = false;
                if(in_array($event->int_name, $arrUserInterests)){
                    $event->fitToMe = true;
                }
                //dd($event);
            }
        }

        $data = new \stdClass();
        $data->events = $eventsList;
        $data->userInterestsList = $arrUserInterests;
        $data->user_firstname = $user_firstname;

		return view('home/index')->with('data', $data);
	}


    protected function _isUserComingToEvent($user_id, $event_id) {

        $isComing = false;

        $modEvent = new Event();
        $arrUserUpcomingEvent = $modEvent->getUpcommingEventsByUser($user_id);

        foreach($arrUserUpcomingEvent as $event){
            if($event->eve_id == $event_id){
                $isComing = true;
                break;
            }
        }

        return $isComing;

    }

}
