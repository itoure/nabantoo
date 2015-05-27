<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDate extends Model {

    public $timestamps = false;
    protected $fillable = ['event_id', 'eve_start_date'];

}
