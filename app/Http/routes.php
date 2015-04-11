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

//Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

Route::controller('home', 'DashboardController');
Route::controller('user/create', 'UserController');
Route::controller('user', 'UserController');
Route::controller('rendezvous', 'RendezvousController');
Route::controller('utils', 'UtilsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
