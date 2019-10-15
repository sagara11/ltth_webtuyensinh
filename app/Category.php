<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    public function posts()
    {
    	return $this->hasMany('App\Post','category_id','id');
    }
    public function child_category()
    {
    	return $this->hasMany('App\Category', 'parent_id');
    }
    public function parent_category()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }
}
