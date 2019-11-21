<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Support\Carbon;
class Post extends Model
{
    protected $table = "posts";

    public function categories()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }
    public function source()
    {
    	return $this->belongsTo('App\Crawl','source_id','id');
    }
    public function time(){
        $now = Carbon::now();
        return $now->diffInHours($this->created_at);
    }
}
