<?php

namespace App\Http\Controllers\API;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Category;

class PostsController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function posts(Request $request)
    {
        $type = 'post';
        $posts = Post::select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
        $posts->where('type_post', '=', $type);

        $name        = isset($request->name) ? $request->name : '';
        $limit       = isset($request->limit) ? $request->limit : 10 ;
        $page        = isset($request->page) ? $request->page : 1 ;
        $category_id = isset($request->category_id) ? $request->category_id : 'all';
        $select      = isset($request->type) ? $request->type : 'all';

        if($select != 'all')
        {
            return $this->sort($select);
        }
        if($name != '') {
            $posts->where('name',$name);
        }
        if($category_id !='all'){
            $posts->where('category_id',$category_id);
        }
        if($request->limit != 10)
        {
            $posts = $posts->paginate($request->limit);
            return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
        }

        $posts = $posts->paginate(10);
        return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
    }
    public function sort($select)
    {
        if($select == 'hot')
        {
            $posts = Post::orderBy('view','DESC')->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate(10);
            return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
        }
        elseif($select == 'newest')
        {
            $posts = Post::orderBy('created_at','DESC')->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate(10);
            return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
        }
        elseif($select == 'trend')
        {
            $posts = Post::where('trend',1)->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate(10);
            return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
        }
    }

    public function post(Request $request)
    {
        $type = 'post';
        $posts = Post::select('id','name','image','description','content','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
        $posts->where('type_post', '=', $type);

        $id    = isset($request->id) ? $request->id : '';
        $limit = isset($request->limit) ? $request->limit : 10 ;
    
        if($id != '') {
            $posts->where('id',$id);
        }
        if($request->limit != 10)
        {
            $posts = $posts->paginate($request->limit);
            return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
        }
        $posts = $posts->paginate(10);
        return $this->sendResponse($posts, 'Post retrieved successfully.','posts');
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
}