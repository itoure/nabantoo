<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

	//
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
