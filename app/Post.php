<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Post extends Model
{
    protected $table = "posts";

    public function categories()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }
}
