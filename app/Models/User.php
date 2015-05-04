<?php namespace App\Models;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserInterest;
use App\Models\UserLocation;

class User extends Model {

    protected $guarded = ['usr_id'];
    public $primaryKey = 'usr_id';


    public function getCompleteUserById($user_id) {

        // get user interest
        $modUserInterest = new UserInterest();
        $arrUserInterests = $modUserInterest->getUserInterests($user_id);

        // get user location
        $modUserLocation = new UserLocation();
        $arrUserLocations = $modUserLocation->getUserLocation($user_id);

        // get user
        $user = DB::table('users')->where('users.usr_id', '=', $user_id)->first();
        $user->interests = $arrUserInterests;
        $user->locations = $arrUserLocations;
        //dd($user);

        return $user;

    }


}
