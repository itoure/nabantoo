<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model {

    protected $guarded = ['usr_msg_id'];
    public $primaryKey = 'usr_msg_id';

}
