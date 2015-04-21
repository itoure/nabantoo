<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'interest_id'];

    public function interest(){
        return $this->belongsTo('App\Models\Interest');
    }


    public function getUserInterests($user_id) {

        $result = self::where('user_id', '=', $user_id)->with('interest')->get();

        $arrInterests = array();
        foreach($result as $item){
            $arrInterests[$item->interest_id] = $item->interest->int_name;
        }

        return $arrInterests;

    }


    public function getUserInterestIds($usr_id) {

        $dbUserInterest = self::where('user_id', '=', $usr_id)->get();

        $arrUserInterestIds = array();
        foreach($dbUserInterest as $interest){
            $arrUserInterestIds[] = $interest->interest_id;
        }

        return $arrUserInterestIds;

    }

}
