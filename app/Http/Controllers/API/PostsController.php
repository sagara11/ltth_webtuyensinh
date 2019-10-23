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
        
        $posts = $posts->paginate($limit);
        return $this->sendResponse($posts, 'Post read successfully.','posts');
    }
    public function sort($select)
    {
        $limit = isset($request->limit) ? $request->limit : 10 ;
        if($select == 'hot')
        {
            $posts = Post::orderBy('view','DESC')->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate($limit);
            return $this->sendResponse($posts, 'Post sorted successfully.','posts');
        }
        elseif($select == 'newest')
        {
            $posts = Post::orderBy('created_at','DESC')->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate($limit);
            return $this->sendResponse($posts, 'Post sorted successfully.','posts');
        }
        elseif($select == 'trend')
        {
            $posts = Post::where('trend',1)->select('id','name','image','description','created_at','view','comment','category_id')->with(array(
            'categories' => function($posts)
            {
                $posts->select('id','name');
            }))->where('publish', 1);
            $posts = $posts->paginate($limit);
            return $this->sendResponse($posts, 'Post sorted successfully.','posts');
        }
    }

    public function post(Request $request)
    {
        if(isset($request->id) && $request->id != null)
        {
            // lay bai viet
            // $limit = isset($request->limit) ? $request->limit : 1 ;
            $type = 'post';
            $post = Post::where('id',$request->id)->select('id','name','image','description','content','created_at','view','comment','category_id')->with(array(
                'categories' => function($post)
                {
                    $post->select('id','name');

                }))->where('publish', 1);

            $post->where('type_post', '=', $type);

            $post = $post->first();

            $post->view = $post->view + 1 ;
            $post->save();
            // cac bai viet lien quan
            $related = Post::where('category_id',$post->category_id)->select('id','name','image','description','created_at','view','comment','category_id');

            $related->with(array(
                'categories' => function($related)
                {
                    $related->select('id','name');

                }))->where('publish', 1)->get();

            $related->where('type_post', '=', $type)->where('id','!=',$post->id);

            $related = $related->get();

            $response = [
                        'status'  => true,
                        'post'    =>$post,
                        'related' =>$related,
                    ];
            return response()->json($response);
        }
        else
        {
             $response = [
                        'status' => false,
                        'message' => 'Please fill the id !!!',
                    ];
            return response()->json($response);
        }
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