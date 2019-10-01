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
        $categories = Category::select('id','name','image')->where('publish', 1);

        $limit       = isset($request->limit) ? $request->limit : 10 ;
        $page        = isset($request->page) ? $request->page : 1 ;

        if($request->limit != 10)
        {
            $categories = $categories->paginate($request->limit);
            return $this->sendResponse($categories, 'Post retrieved successfully.','categories');
        }

        $categories = $categories->paginate(10);
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