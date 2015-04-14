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
    public function saveLocation(array $inputs){

        $arrLocations = array();
        $arrLocations['short_sublocality_level_1'] = $inputs['short_sublocality_level_1'];
        $arrLocations['long_sublocality_level_1'] = $inputs['long_sublocality_level_1'];
        $arrLocations['short_locality'] = $inputs['short_locality'];
        $arrLocations['long_locality'] = $inputs['long_locality'];
        $arrLocations['short_administrative_area_level_2'] = $inputs['short_administrative_area_level_2'];
        $arrLocations['long_administrative_area_level_2'] = $inputs['long_administrative_area_level_2'];
        $arrLocations['short_administrative_area_level_1'] = $inputs['short_administrative_area_level_1'];
        $arrLocations['long_administrative_area_level_1'] = $inputs['long_administrative_area_level_1'];
        $arrLocations['short_postal_code'] = $inputs['short_postal_code'];
        $arrLocations['long_postal_code'] = $inputs['long_postal_code'];
        $arrLocations['short_postal_code_prefix'] = $inputs['short_postal_code_prefix'];
        $arrLocations['long_postal_code_prefix'] = $inputs['long_postal_code_prefix'];
        $arrLocations['short_country'] = $inputs['short_country'];
        $arrLocations['long_country'] = $inputs['long_country'];

        $insertedLocation =  self::create($arrLocations);

        if($insertedLocation->loc_id){
            return $insertedLocation->loc_id;
        }

        return false;

    }


}
