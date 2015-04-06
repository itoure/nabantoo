<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'interest_id'];

}
