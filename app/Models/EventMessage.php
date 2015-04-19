<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMessage extends Model {

    protected $guarded = ['eve_msg_id'];
    public $primaryKey = 'eve_msg_id';

}
