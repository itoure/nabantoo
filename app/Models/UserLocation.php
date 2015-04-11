<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'location_id'];


    public function location(){
        return $this->belongsTo('App\Models\Location');
    }


    public function getUserLocation($user_id){

        $result = self::where('user_id', '=', $user_id)->with('location')->get();

        $arrLocations = array();
        foreach($result as $item){
            $arrLocation = array();
            $arrLocation['short_sublocality_level_1'] = $item->location->short_sublocality_level_1;
            $arrLocation['long_sublocality_level_1'] = $item->location->long_sublocality_level_1;
            $arrLocation['short_locality'] = $item->location->short_locality;
            $arrLocation['long_locality'] = $item->location->long_locality;
            $arrLocation['short_administrative_area_level_2'] = $item->location->short_administrative_area_level_2;
            $arrLocation['long_administrative_area_level_2'] = $item->location->long_administrative_area_level_2;
            $arrLocation['short_administrative_area_level_1'] = $item->location->short_administrative_area_level_1;
            $arrLocation['long_administrative_area_level_1'] = $item->location->long_administrative_area_level_1;
            $arrLocation['short_postal_code'] = $item->location->short_postal_code;
            $arrLocation['long_postal_code'] = $item->location->long_postal_code;
            $arrLocation['short_postal_code_prefix'] = $item->location->short_postal_code_prefix;
            $arrLocation['long_postal_code_prefix'] = $item->location->long_postal_code_prefix;
            $arrLocation['short_country'] = $item->location->short_country;
            $arrLocation['long_country'] = $item->location->long_country;

            $arrLocations[] = $arrLocation;
        }

        return $arrLocations;

    }

}
