<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }


    public function getUserEventsByInterestsAndLocation($interest_ids, $arrUserLocation) {

        $result = self::whereIn('interest_id', $interest_ids)->with('location')->get();

        return $result;

    }
}
