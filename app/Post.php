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
    public function user()
    {
    	return $this->belongsTo('App\Users','user_id','id');
    }
    public function hour(){
        Carbon::setlocale('vi');
        $now = Carbon::now();
        return $this->created_at->diffForHumans($now);
    }
}
