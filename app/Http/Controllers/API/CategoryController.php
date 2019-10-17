<?php

namespace App\Http\Controllers\API;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

 
class CategoryController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function index(Request $request)
    {
        $categories = Category::select('id','name','image','parent_id');
        $limit       = isset($request->limit) ? $request->limit : 10 ;
        $page        = isset($request->page) ? $request->page : 1 ;
        $parent_id = $request->parent_id ;
        if(isset($parent_id))
        {
            $categories = Category::where('parent_id',$parent_id)->select('id','name','image');

            $categories = $categories->paginate($limit);

            return $this->sendResponse($categories, 'Post retrieved successfully.','categories');
        }
        $categories->where('parent_id', NULL);

        $categories->with(array('child_category' => function($q) {
                    return $q->select('id','name','image', 'parent_id');
                }
            ));

        $categories = $categories->paginate($limit);
        return $this->sendResponse($categories, 'Post retrieved successfully.','categories');
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