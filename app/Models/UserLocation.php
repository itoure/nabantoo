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
            $objLocation = new \stdClass();
            $objLocation->location_id = $item->location->loc_id;
            $objLocation->short_sublocality_level_1 = $item->location->short_sublocality_level_1;
            $objLocation->long_sublocality_level_1 = $item->location->long_sublocality_level_1;
            $objLocation->short_locality = $item->location->short_locality;
            $objLocation->long_locality = $item->location->long_locality;
            $objLocation->short_administrative_area_level_2 = $item->location->short_administrative_area_level_2;
            $objLocation->long_administrative_area_level_2 = $item->location->long_administrative_area_level_2;
            $objLocation->short_administrative_area_level_1 = $item->location->short_administrative_area_level_1;
            $objLocation->long_administrative_area_level_1 = $item->location->long_administrative_area_level_1;
            $objLocation->short_postal_code = $item->location->short_postal_code;
            $objLocation->long_postal_code = $item->location->long_postal_code;
            $objLocation->short_postal_code_prefix = $item->location->short_postal_code_prefix;
            $objLocation->long_postal_code_prefix = $item->location->long_postal_code_prefix;
            $objLocation->short_country = $item->location->short_country;
            $objLocation->long_country = $item->location->long_country;

            $arrLocations[] = $objLocation;
        }

        return $arrLocations;

    }

}
