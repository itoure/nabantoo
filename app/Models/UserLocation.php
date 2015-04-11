<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'location_id'];

}
