<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
class Comment extends Model
{
    protected $table = "comments";

    public function post()
    {
    	return $this->belongsTo('App\Post','post_id','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function child_comments()
    {
    	return $this->hasMany('App\Comment', 'parent_id');
    }
    public function parent_comment()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }
}
