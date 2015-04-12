<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    public $timestamps = false;
    protected $guarded = ['loc_id'];
    public $primaryKey = 'loc_id';


    /**
     * Save locations datas from user form
     * @param array $locations
     * @return static
     */
    public function saveLocationsFromUserForm(array $inputs){

        $arrLocations = array();
        $arrLocations['sublocality_level_1'] = $inputs['sublocality_level_1'];
        $arrLocations['locality'] = $inputs['locality'];
        $arrLocations['administrative_area_level_2'] = $inputs['administrative_area_level_2'];
        $arrLocations['administrative_area_level_1'] = $inputs['administrative_area_level_1'];
        $arrLocations['postal_code'] = $inputs['postal_code'];
        $arrLocations['postal_code_prefix'] = $inputs['postal_code_prefix'];
        $arrLocations['country'] = $inputs['country'];

        $arrToInsert = array();
        foreach($arrLocations as $field => $location){
            if(!empty($location)){
                $expLocation = explode('|', $location);
                $arrToInsert['short_'.$field] = $expLocation[0];
                $arrToInsert['long_'.$field] = $expLocation[1];
            }
        }

        $insertedLocation =  self::create($arrToInsert);

        if($insertedLocation->loc_id){
            return $insertedLocation->loc_id;
        }

        return false;

    }


    public function getUserLocation($user_id) {



    }

}
