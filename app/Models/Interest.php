<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Interest extends Model {

    public $timestamps = false;
    public $primaryKey = 'int_id';
    protected $guarded = ['int_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function getAllInterests() {

        $query = DB::table('interests')
            ->join('categories', 'interests.category_id', '=', 'categories.cat_id')
            ->orderBy('int_name');

        $result = $query->get();
        //dd($result);

        return $result;

    }
}
