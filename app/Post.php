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
    public function hour(){
        $now = Carbon::now();
        return $now->diffInHours($this->created_at);
    }
    public function day(){
        $day = $this->created_at->toDateString();
        return $day;
    }
}
