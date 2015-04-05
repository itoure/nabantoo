<?php namespace App\Http\Controllers;


//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

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
	public function __construct()
	{
		//$this->middleware('guest');
	}

    /**
     * Show form to create an account
     *
     * @return Response
     */
    public function getCreate()
    {
        return view('user/create');
    }


    /**
     * Valid the form and store datas in the DB
     *
     * @return Response
     */
    public function postStore()
    {

        $rules = array(
            'firstname' => 'required|alpha',
            'sexe' => 'required|alpha|size:1',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('UserController@getCreate')->withErrors($validator)->withInput();
        } else {
            $firstname = Input::get('firstname');
            $sexe = Input::get('sexe');
            $birthday = Input::get('birthday');
            $email = Input::get('email');
            $password = Input::get('password');

//            User::create(array(
//                'amount' => $amount,
//                'planned_at' => $planned_at,
//                'category_id' => $category,
//            ));

            return Redirect::action('DashboardController@getIndex');
        }

    }


	/**
	 * Show the user account details
	 *
	 * @return Response
	 */
	public function getAccount()
	{
		return view('user/account');
	}

}
