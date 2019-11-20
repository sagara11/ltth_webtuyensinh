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
    	return Category::where('id', $this->category_id)->first();
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
