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

        $user_firstname = $this->request->user()->usr_firstname;

        $data = new \stdClass();
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
