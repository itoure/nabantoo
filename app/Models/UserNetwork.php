<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNetwork extends Model {

    public $timestamps = false;
    protected $fillable = ['user_id', 'member_id'];

}
