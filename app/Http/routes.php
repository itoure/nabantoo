<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('rendezvous/{event_id}/details', 'RendezvousController@getDetails');
Route::resource('admin/interests', 'InterestController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'user' => 'UserController',
	'event' => 'EventController',
	'utils' => 'UtilsController',
    '/' => 'HomeController',
]);

