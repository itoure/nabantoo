<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model {

    protected $guarded = ['eve_id'];
    public $primaryKey = 'eve_id';

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }


    public function getUserEventsByInterestsAndLocation($arrUserInterestIds, $arrUserLocation) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->whereIn('interest_id', $arrUserInterestIds)
            ->where(function($query) use($arrUserLocation)
            {
                $query->orWhere('locations.short_locality', '=', $arrUserLocation->short_locality)
                    ->orWhere('locations.short_administrative_area_level_2', '=', $arrUserLocation->short_administrative_area_level_2)
                    ->orWhere('locations.short_administrative_area_level_1', '=', $arrUserLocation->short_administrative_area_level_1);
            });

        $result = $query->get();
        //dd($result);

        return $result;

    }


    public function getUpcommingEventsByUser($user_id) {

        $query = DB::table('user_events')
            ->join('events', 'user_events.event_id', '=', 'events.eve_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->where('user_events.user_id', '=', $user_id);

        $result = $query->get();
        //dd($result->toSql);

        return $result;

    }


    public function getCompleteEventById($event_id) {
        $query = DB::table('events')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->where('events.eve_id', '=', $event_id);

        $result = $query->first();
        //dd($result);

        return $result;

    }

}
