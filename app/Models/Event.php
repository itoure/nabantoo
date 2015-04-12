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
            ->whereIn('interest_id', $arrUserInterestIds)
            ->where(function($query) use($arrUserLocation)
            {
                $query->orWhere('locations.short_locality', '=', $arrUserLocation[0]['short_locality'])
                    ->orWhere('locations.short_administrative_area_level_2', '=', $arrUserLocation[0]['short_administrative_area_level_2'])
                    ->orWhere('locations.short_administrative_area_level_1', '=', $arrUserLocation[0]['short_administrative_area_level_1']);
            });

        $result = $query->get();
        //dd($result);

        return $result;

    }


    public function getUpcommingEventsByUser($user_id) {

        $query = DB::table('user_events')
            ->join('events', 'user_events.event_id', '=', 'events.eve_id')
            ->where('user_events.user_id', '=', $user_id);

        $result = $query->get();
        //dd($result->toSql);

        return $result;

    }

}
