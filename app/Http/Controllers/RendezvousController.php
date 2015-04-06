<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Event;
use App\Models\Interest;
use App\Models\City;

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
	public function __construct()
	{
		//$this->middleware('guest');
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
            $arrInterests[$interest->category->name][$interest->id] = $interest->name;
        }

        // get all cities from db
        $db_cities = City::where('country_id', '=', 1)->get();
        $arrCities = array('' => 'Where ?');
        foreach($db_cities as $city){
            $arrCities[$city->id] = $city->name;
        }

        $data = new \stdClass();
        $data->interests = $arrInterests;
        $data->cities = $arrCities;

		return view('rendezvous/create')->with('data', $data);
	}

    /**
     * Valid create rdv form and store datas in the DB
     *
     * @return Response
     */
    public function postStore()
    {
        $fileFolder = env('APP_FILE_FOLDER');

        $rules = array(
            'title' => 'required|string',
            'details' => 'required|string',
            'city' => 'required|integer',
            'photo' => 'image',
            'start_date' => 'required|date',
            'end_date' => 'date',
            'category' => 'required|integer',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('RendezvousController@getCreate')->withErrors($validator)->withInput();
        } else {
            $title = Input::get('title');
            $details = Input::get('details');
            $city = Input::get('city');
            $photo = Input::file('photo');
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $category = Input::get('category');

            // photo
            $photoName = null;
            if($photo){
                if ($photo->isValid()) {
                    $photo->move($fileFolder.'/event/', $photo->getClientOriginalName());
                    $photoName = $photo->getClientOriginalName();
                }
            }

            Event::create(array(
                'title' => $title,
                'details' => $details,
                'city_id' => $city,
                'photo' => $photoName,
                'start_date' => strtotime($start_date),
                'end_date' => strtotime($end_date),
                'interest_id' => $category,
                'user_id' => 1,
            ));

            return Redirect::action('DashboardController@getIndex');
        }

    }

}
