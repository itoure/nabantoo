<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $guarded = ['usr_id'];
    public $primaryKey = 'usr_id';

}
