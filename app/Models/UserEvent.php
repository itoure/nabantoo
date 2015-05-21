<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'event_id', 'user_event_choice'];

}
