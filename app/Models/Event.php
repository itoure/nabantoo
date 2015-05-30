<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserEvent;
use App\Models\EventMessage;

class Event extends Model {

    protected $guarded = ['eve_id'];
    public $primaryKey = 'eve_id';

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }

    public function getEventsByInterest($interest_id, $event_id, $arrUserLocation) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->where('locations.short_country', '=', $arrUserLocation->short_country)
            ->where('interests.int_id', '=', $interest_id)
            ->where('events.eve_id', '<>', $event_id);

        $result = $query->get();
        //dd($result);

        return $result;

    }

    public function getEventsByCountry($arrUserLocation, $excludedEventIds = array()) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->whereNotIn('events.eve_id', $excludedEventIds)
            ->where('locations.short_country', '=', $arrUserLocation->short_country);

        $result = $query->get();
        //dd($result);

        return $result;

    }


    public function getUserEventsByInterestsAndLocation($arrUserInterestIds, $arrUserLocation, $excludedEventIds = array()) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->whereIn('interest_id', $arrUserInterestIds)
            ->whereNotIn('events.eve_id', $excludedEventIds)
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


    public function getEventsByUserInterests($arrUserInterestIds, $excludedEventIds = array()) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->whereNotIn('events.eve_id', $excludedEventIds)
            ->whereIn('interest_id', $arrUserInterestIds);

        $result = $query->get();
        //dd($result);

        return $result;

    }

    public function getEventsByUserLocation($arrUserLocation, $excludedEventIds = array()) {

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->whereNotIn('events.eve_id', $excludedEventIds)
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


    public function getParticipantsByEvent($event_id) {

        $query = DB::table('user_events')
            ->join('users', 'users.usr_id', '=', 'user_events.user_id')
            ->where('user_events.event_id', '=', $event_id)
            ->whereIn('user_events.user_event_choice', array('ok','host'));

        $result = $query->get();
        //dd($result);

        return $result;

    }


    public function getEventsIdsByUserAndStatus($user_id, $status = null) {

        $query = DB::table('user_events')
            ->join('events', 'user_events.event_id', '=', 'events.eve_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->where('user_events.user_id', '=', $user_id);

        if($status){
            $query->where('user_events.user_event_choice', '=', $status);
        }

        $result = $query->lists('eve_id');
        //dd($result);

        return $result;

    }


    public function getUpcommingEventsByUser($user_id, $excludedEventIds = array()) {

        $query = DB::table('user_events')
            ->join('events', 'user_events.event_id', '=', 'events.eve_id')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->where('user_events.user_id', '=', $user_id)
            ->whereNotIn('events.eve_id', $excludedEventIds)
            ->whereIn('user_events.user_event_choice', array('ok', 'host'));

        $result = $query->get();
        //dd($result->toSql);

        return $result;

    }


    public function getCompleteEventById($event_id) {
        $query = DB::table('events')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->where('events.eve_id', '=', $event_id);

        $result = $query->first();
        //dd($result);

        return $result;

    }


    public function countParticipantsByEvent($event_id) {

        $count = UserEvent::where('event_id', '=', $event_id)
            ->whereIn('user_events.user_event_choice', array('ok', 'host'))
            ->count();
        //dd($count);

        return $count;

    }


    public function getAllMessagesByEvent($event_id) {

        $query = DB::table('event_messages')
            ->join('users', 'users.usr_id', '=', 'event_messages.user_id')
            ->where('event_messages.event_id', '=', $event_id);

        $result = $query->get();
        //dd($result->toSql);

        return $result;
    }

    public function getHostEventByUser($user_id) {

        $query = DB::table('events')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->where('events.user_id', '=', $user_id);

        $result = $query->get();
        //dd($result->toSql);

        return $result;

    }


    public function getEventsInNetwork($membersIds){

        $query = DB::table('events')
            ->join('locations', 'locations.loc_id', '=', 'events.location_id')
            ->join('users', 'users.usr_id', '=', 'events.user_id')
            ->join('interests', 'interests.int_id', '=', 'events.interest_id')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->join('event_dates', 'event_dates.event_id', '=', 'events.eve_id')
            ->whereIn('events.user_id', $membersIds);

        $result = $query->get();
        //dd($result);

        return $result;

    }


    public function getEventStatus($event_id, $user_id){

        $user_event_choice = DB::table('user_events')
            ->where('user_events.event_id', '=', $event_id)
            ->where('user_events.user_id', '=', $user_id)
            ->pluck('user_event_choice');

        return $user_event_choice;

    }

}
