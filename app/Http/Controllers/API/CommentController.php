<?php

namespace App\Http\Controllers\API;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Firebase\JWT\JWT;
use RestApi\Utility\JwtToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CommentController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function index(Request $request)
    { 
        if(isset($request->post_id) && $request->post_id != null)
        {
            $post = $request->post_id;
            
            $comments = Comment::select('id','comment','created_at','user_id','parent_id');
            
            $comments->where('post_id', $post)->where('parent_id', NULL);
            
            $comments->with(array( 'user' => function($q) {
                    return $q->select('id','name','avatar');
                }
            ));

            $comments->with(['child_comments' => ( function ($q) use ($post) {
                    return $q->where('post_id', $post)->select('id','comment','created_at','user_id', 'parent_id')->with(array( 'user' => function($q) {
                        return $q->select('id','name','avatar');
                    }
                ));
                }
            )]);

            $limit = isset($request->limit) ? $request->limit : 10 ;
            $comments = $comments->paginate($limit);
            
            $response = [
                        'status' => true,
                        'comments' => $comments,
                    ];
            return response()->json($response);
        }
        else
        {
            $response = [
                        'status' => false,
                        'message' => 'Please fill the post_id',
                    ];
            return response()->json($response);
        }
    }

    public function store(Request $request)
    {
        if(isset($request->post_id) && isset($request->comment) && $request->post_id != '' && $request->comment != '')
        {
            $parent_id = $request->parent_id ? $request->parent_id : null;
            
            $data = new Comment();
            
            $data->comment = $request->comment;
            $data->post_id = $request->post_id;
            $data->parent_id = $parent_id;
            $data->created_at = time();
            $data->updated_at = time();
            $data->publish = $request->publish ? $request->publish : 1 ;
            
            try{
                $token = $request->header('token');
                $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
                $data->user_id = $gettoken[0] ;
                
                $data->save();
                
                $response = [
                            'status' => true,
                            'message' => 'Add success',
                            'id' => $data->id,
                        ];
                return response()->json($response);
            }catch(\Exception $e)
            {
                $response = [
                            'status' => false,
                            'message' => 'Add Fail',
                        ];
                return response()->json($response);
            }
        }
        else
        {
            $response = [
                        'status' => false,
                        'message' => 'Add fail',
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
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
     public function update(Request $request, User $user)
    {
        if(isset($request->comment_id) && isset($request->comment) && $request->comment_id != '' && $request->comment != '')
        {
            $data = Comment::find($request->comment_id);
            if(empty($data))
            {
                $response = [
                        'status' => false,
                        'message' => 'Comment does not exists!!',
                    ];
                return response()->json($response);
            }
            try{
                $token = $request->header('token');
                $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
                if($data->user_id == $gettoken[0])
                {
                    $data->comment = $request->comment;
                    $data->updated_at = time();
                    $data->save();
                    $response = [
                                'status' => true,
                                'message' => 'Update success',
                            ];
                    return response()->json($response);
                }
                else
                {
                    $response = [
                            'status' => false,
                            'message' => 'Update fail!!!',
                        ];
                    return response()->json($response);
                }
            }catch(\Exception $e)
            {
                 $response = [
                            'status' => false,
                            'message' => 'Update fail!!!',
                        ];
                    return response()->json($response);
            }
        }
        else
        {
            $response = [
                        'status' => false,
                        'message' => 'Please fill the comment_id or comment !!!',
                    ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        if(isset($request->comment_id) && $request->comment_id != '')
        {
            $data = Comment::find($request->comment_id);
            if(empty($data))
            {
                $response = [
                        'status' => false,
                        'message' => 'Comment does not exists!!',
                    ];
                return response()->json($response);
            }
            try{
                $token = $request->header('token');
                $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));

                if($data->user_id == $gettoken[0])
                {
                    $data->delete();
                    $response = [
                            'status' => true,
                            'message' => 'Delete success!!!',
                        ];
                    return response()->json($response);
                }
                else
                {
                    $response = [
                                'status' => false,
                                'message' => 'Delete fail!!!',
                            ];
                        return response()->json($response);
                }
            }catch(\Exception $e)
            {
                $response = [
                                'status' => false,
                                'message' => 'Delete fail!!!',
                            ];
                        return response()->json($response);
            }
        }
        else
        {
            $response = [
                        'status' => false,
                        'message' => 'Please fill the comment_id !!!',
                    ];
            return response()->json($response);
        }
    }
}